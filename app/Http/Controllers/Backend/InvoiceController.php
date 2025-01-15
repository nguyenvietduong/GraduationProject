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
use Illuminate\Support\Facades\Log;
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
    const PATH_VIEW = 'backend.invoice.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'invoice';

    public function __construct(
        InvoiceServiceInterface $invoiceService,
        InvoiceRepositoryInterface $invoiceRepository,
        ReservationServiceInterface $reservationService,
        ReservationRepositoryInterface $reservationRepository,
    ) {
        $this->invoiceService = $invoiceService;
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
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];
        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;
        // dd($this->invoiceService->getAllInvoices($filters, $perPage, self::OBJECT));
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'invoiceTotalRecords' => $this->invoiceRepository->count(), // Total records for display
            'invoiceDatas' => $this->invoiceService->getAllInvoices($filters, $perPage, self::OBJECT), // Paginated Category list for the view
        ]);
    }

    public function detail($id)
    {
        // dd($this->reservationService->getReservationDetail($id)->reservationDetails);
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'invoiceDetail' => $this->invoiceService->getInvoiceDetail($id)->invoiceItems,
            'reservationDetail' => $this->reservationService->getReservationDetail($id)->reservationDetails,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // If request data is not empty
        if ($request->payment_method == 'cash') {
            DB::beginTransaction();
            try {
                $data = $request->json()->all();
                $invoiceId = $data['invoiceDetail']['invoice']['id'];

                // Truy vấn tất cả các món thuộc hóa đơn đó
                $invoiceItems = Invoice_item::where('invoice_id', $invoiceId)->get();

                foreach ($invoiceItems as $item) {
                    $statusMenu = json_decode($item->status_menu, true);

                    // Kiểm tra nếu trạng thái "1" hoặc "2" khác "0" -> món chưa lên hết
                    if (($statusMenu["1"] ?? "0") != "0" || ($statusMenu["2"] ?? "0") != "0") {
                        throw new \Exception('Món ăn chưa được phục vụ đầy đủ. Vui lòng kiểm tra lại!');
                    }
                }

                $reservation = Reservation::find($data['invoiceDetail']['reservation']['id']);
                if (!$reservation) {
                    throw new \Exception('Không tìm thấy đặt chỗ.');
                }

                if ($reservation->status == 'completed') {
                    throw new \Exception('Đơn hàng đã được thanh toán.');
                }

                $reservation->update(['status' => 'completed']);

                $dataInvoice = [
                    'total_amount' => $request->total_payment,
                    'status' => 'paid'
                ];
                $invoice = Invoice::where("reservation_id", $reservation->id)->first();
                if (!$invoice) {
                    throw new \Exception('Không tìm thấy hóa đơn.');
                }

                $invoice->update($dataInvoice);

                if (isset($reservation->email)) {
                    Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
                }

                $promotion = Promotion::where('code', $request->code)->first();
                if ($promotion) {
                    PromotionUser::create([
                        'promotion_id' => $promotion->id,
                        'invoice_id' => $invoice->id,
                    ]);
                }

                foreach ($data['invoiceDetail']['reservation']['reservation_details'] as $table) {
                    Table::where('id', $table['table_id'])->update([
                        'status' => "available",
                    ]);
                }
                DB::commit();

                return response()->json(['success' => true, 'message' => 'Thanh toán thành công']);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Lỗi thanh toán: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
        } else {
            DB::beginTransaction();
            try {
                $reservation = Reservation::find($request->reservation_id);
                if (!$reservation) {
                    throw new \Exception('Không tìm thấy đặt chỗ.');
                }

                if ($reservation->status == 'completed') {
                    throw new \Exception('Đơn hàng đã được thanh toán.');
                }

                $reservation->update(['status' => 'completed']);

                $invoice = Invoice::where("reservation_id", $reservation->id)->first();
                if (!$invoice) {
                    throw new \Exception('Không tìm thấy hóa đơn.');
                }

                $invoice->update([
                    'total_amount' => $request->total_payment,
                    'status' => 'paid',
                    'payment_method' => 'bank',
                    'isExport' => true
                ]);

                if (isset($reservation->email)) {
                    Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
                }

                $promotion = Promotion::where('code', $request->code)->first();
                if ($promotion) {
                    PromotionUser::create([
                        'promotion_id' => $promotion->id,
                        'invoice_id' => $invoice->id,
                    ]);
                }

                foreach ($reservation->reservationDetails as $table) {
                    Table::where('id', $table->table_id)->update([
                        'status' => "available",
                    ]);
                }

                $fileName = 'invoice_' . $reservation->id . '.pdf';
                $filePath = 'pdf/' . $fileName;

                $pdf = Pdf::loadView('backend.reservation.invoice_pdf', compact('reservation'));
                Storage::disk('public')->put($filePath, $pdf->output());
                $pdfUrl = Storage::url($filePath);

                DB::commit();

                return response()->json([
                    'success' => 'Đặt chỗ và thanh toán thành công.',
                    'pdfUrl' => $pdfUrl
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Lỗi thanh toán: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
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

        // Lấy invoice nếu có
        $invoice = Invoice::where('reservation_id', $reservationId)->first(); // Fetch the first invoice
        if ($invoice) {
            $invoice->update(['isExport' => true]);
        }

        // Tạo tên file PDF
        $fileName = 'invoice_' . $reservation->id . '.pdf';
        $filePath = 'pdf/' . $fileName;

        // Kiểm tra nếu file đã tồn tại
        if (Storage::disk('public')->exists($filePath)) {
            // Nếu file đã tồn tại, lấy URL của file đó
            $pdfUrl = Storage::url($filePath);
            return response()->json(['success' => true, 'pdfUrl' => $pdfUrl]);
        }

        // Nếu file chưa tồn tại, tạo file PDF mới
        $pdf = Pdf::loadView('backend.reservation.invoice_pdf', compact('reservation'));

        // Lưu file PDF vào storage/public/pdf
        Storage::disk('public')->put($filePath, $pdf->output());

        // Trả về URL của file PDF mới
        if (Storage::disk('public')->exists($filePath)) {
            // Nếu file đã tồn tại, lấy URL của file đó
            $pdfUrl = Storage::url($filePath);
            return response()->json(['success' => true, 'pdfUrl' => $pdfUrl]);
        }
    }
}
