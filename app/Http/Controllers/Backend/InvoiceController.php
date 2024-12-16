<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\InvoiceRepositoryInterface;
use App\Interfaces\Services\InvoiceServiceInterface;
use App\Traits\HandleExceptionTrait;
use App\Mail\ReservationConfirmed;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;

use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// Requests
use App\Http\Requests\BackEnd\Invoices\ListRequest as InvoiceListRequest;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Models\PromotionUser;
use Illuminate\Support\Facades\File;

class InvoiceController extends Controller
{
    use HandleExceptionTrait;

    protected $invoiceService;
    protected $invoiceRepository;
    protected $reservationService;
    protected $reservationRepository;
    // Base path for views
    const PATH_VIEW        = 'backend.invoice.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT           = 'invoice';

    public function __construct(
        InvoiceServiceInterface $invoiceService,
        InvoiceRepositoryInterface $invoiceRepository,
        ReservationServiceInterface $reservationService,
        ReservationRepositoryInterface $reservationRepository,
    ) {
        $this->invoiceService    = $invoiceService;
        $this->invoiceRepository = $invoiceRepository;
        $this->reservationService = $reservationService;
        $this->reservationRepository = $reservationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(InvoiceListRequest $request)
    {
        // $this->authorize('modules', '' . self::OBJECT . '.index');
        session()->forget('image_temp'); // Clear temporary image value
        // Validate the request data
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search'     => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date'   => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];
        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;
        // dd($this->invoiceService->getAllInvoices($filters, $perPage, self::OBJECT));
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'                => self::OBJECT,
            'invoiceTotalRecords'  => $this->invoiceRepository->count(), // Total records for display
            'invoiceDatas'         => $this->invoiceService->getAllInvoices($filters, $perPage, self::OBJECT), // Paginated Category list for the view
        ]);
    }

    public function detail($id)
    {
        // dd($this->reservationService->getReservationDetail($id)->reservationDetails);
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'                => self::OBJECT,
            'invoiceDetail'         => $this->invoiceService->getInvoiceDetail($id)->invoiceItems,
            'reservationDetail'     => $this->reservationService->getReservationDetail($id)->reservationDetails,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // If request data is not empty
        if ($request->payment_method == 'cash') {
            $data = $request->json()->all(); // Get the request data
            // Find the reservation and update status to 'completed'
            $reservation = Reservation::find($data['invoiceDetail']['reservation']['id']);

            if (!$reservation) {
                // Reservation not found
                return response()->json(['error' => 'Không tìm thấy đặt chỗ.'], 404);
            }

            if ($reservation->status == 'completed') {
                return response()->json(['error' => 'Đơn hàng đã được thanh toán.']);
            }    

            // Update reservation status
            $reservation->update(['status' => 'completed']);

            // Prepare invoice data and update invoice
            $dataInvoice = [
                'total_amount' => $request->total_payment,
                'status' => 'paid'
            ];
            $invoice = Invoice::where("reservation_id", $reservation->id)->first();
            if ($invoice) {
                $invoice->update($dataInvoice);

                if (isset($reservation->email)) {
                    Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
                }
            } else {
                return response()->json(['error' => 'Không tìm thấy hóa đơn.'], 404);
            }

            // Handle promotion if present
            $promotion = Promotion::where('code', $request->code)->first();
            if ($promotion) {
                PromotionUser::create([
                    'promotion_id' => $promotion->id,
                    'invoice_id' => $invoice->id,
                ]);
            }

            // Update table statuses to "available"
            foreach ($data['invoiceDetail']['reservation']['reservation_details'] as $table) {
                Table::where('id', $table['table_id'])->update([
                    'status' => "available",
                ]);
            }
            // $this->exportAndSavePDF($reservation->id);
            return response()->json(['success' => 'Đặt chỗ và thanh toán thành công.']);
        } else {
            // dd($request->all());
            // If no data was provided, process the request with reservation_id
            $reservation = Reservation::find($request->reservation_id);
            // dd($reservation);

            if (!$reservation) {
                // Reservation not found
                return response()->json(['error' => 'Không tìm thấy đặt chỗ.'], 404);
            }

            // If reservation is already completed
            if ($reservation->status == 'completed') {
                return response()->json(['error' => 'Đơn hàng đã được thanh toán.']);
            }

            // Update reservation status to 'completed'
            $reservation->update(['status' => 'completed']);

            // Prepare invoice data and update the invoice
            $invoice = Invoice::where("reservation_id", $reservation->id)->first();

            if ($invoice) {
                $invoice->update([
                    'total_amount' => $request->total_payment,
                    'status' => 'paid',
                    'payment_method' => 'bank'  // This assumes it's a bank payment, adjust if other methods are possible
                ]);

                if (isset($reservation->email)) {
                    Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
                }
            } else {
                return response()->json(['error' => 'Không tìm thấy hóa đơn.'], 404);
            }

            // Handle promotion
            $promotion = Promotion::where('code', $request->code)->first();
            if ($promotion) {
                PromotionUser::create([
                    'promotion_id' => $promotion->id,
                    'invoice_id' => $invoice->id,
                ]);
            }

            // Update table statuses to "available"
            foreach ($reservation->reservationDetails as $table) {
                Table::where('id', $table->table_id)->update([
                    'status' => "available",
                ]);
            }

            // $this->exportAndSavePDF($reservation->id);
            return response()->json(['success' => 'Đặt chỗ và thanh toán thành công.']);
        }
    }

    public function exportAndSavePDF(Request $request)
    {
        // Lấy reservationId từ dữ liệu JSON
        $reservationId = $request->reservation_id;
    
        // Kiểm tra nếu Reservation tồn tại
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return response()->json(['success' => false, 'message' => 'Reservation not found']);
        }
    
        // Tạo file PDF từ view
        $pdf = Pdf::loadView('backend.reservation.invoice_pdf', compact('reservation'));

        // Đặt tên file PDF
        $fileName = 'invoice_' . $reservation->id . '.pdf';
    
        // Lưu file PDF vào storage/public/pdf
        $filePath = 'pdf/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());
    
        // Trả về URL của file PDF trong storage
        $pdfUrl = Storage::url($filePath);
    
        // Trả về phản hồi JSON với URL
        return response()->json(['success' => true, 'pdfUrl' => $pdfUrl]);
    }    
}
