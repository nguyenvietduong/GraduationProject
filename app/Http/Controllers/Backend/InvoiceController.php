<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\InvoiceRepositoryInterface;
use App\Interfaces\Services\InvoiceServiceInterface;
use App\Traits\HandleExceptionTrait;

use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;

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
        try {
            DB::transaction(function () use ($request) {
                $reservation = Reservation::find($request->reservation_id);

                

                $reservation->update(['status' => 'completed']);
                $dataInvoice = [
                    'reservation_id' => $request->reservation_id,
                    'total_amount' => $request->total_payment,
                    'payment_method' => $request->payment_method,
                    'status' => 'paid',
                ];

                $invoice = Invoice::create($dataInvoice);
                $promotion = Promotion::where('code', $request->code)->first();
                if ($promotion) {
                    PromotionUser::create([
                        'promotion_id' => $promotion->id,
                        'invoice_id' => $invoice->id,
                    ]);
                }
                foreach ($request->invoice_item as $data) {
                    Invoice_item::create([
                        'invoice_id' => $invoice->id,
                        'menu_id' => $data['id'],
                        'quantity' => $data['quantity'],
                        'price' => $data['price'],
                        'total' => $data['total']
                    ]);
                }
                foreach ($request->list_tables as $table) {
                    Table::where('id', $table['id'])->update([
                        'status' => "available",
                    ]);
                }

                $jsonFile = base_path('db.json');

                $jsonData = File::get($jsonFile);
                $invoiceJson = json_decode($jsonData, true); // Chuyển dữ liệu thành mảng

                // Tìm index của bản ghi có id cần xóa

                if (isset($invoiceJson['invoice'])) {
                    // Tìm và xóa phần tử trong mảng 'invoice' có reservation_id khớp
                    $invoiceJson['invoice'] = array_filter($invoiceJson['invoice'], function ($invoice) use ($request) {
                        return $invoice['reservation_id'] != $request->reservation_id;
                    });

                    // Đảm bảo mảng không có các phần tử rỗng sau khi filter
                    $invoiceJson['invoice'] = array_values($invoiceJson['invoice']);

                    // Lưu lại dữ liệu vào file db.json
                    File::put($jsonFile, json_encode($invoiceJson, JSON_PRETTY_PRINT));
                }
            });
            return response()->json(['success' => 'Thêm mới thành công']);
        } catch (\Throwable $th) {
        }
    }
    public function exportAndSavePDF(Request $request)
    {
        $invoice_item = $request->invoice_item;
        $total_payment = $request->total_payment;
        $voucher_discount = $request->voucher_discount;
        $code = '';
        if (isset($request->code)) {
            $code = Promotion::where('code', $request->code)->first();
        }
        $res = Restaurant::get()->first();
        $reservation = Reservation::find($request->reservation_id);
        // Tạo file PDF từ view với dữ liệu truyền vào
        $pdf = Pdf::loadView('backend.reservation.invoice_pdf', compact('res', 'reservation', 'invoice_item', 'total_payment', 'code', 'voucher_discount'));

        $pdfContent = $pdf->output();

        return response()->json([
            'success' => true,
            'fileName' => 'invoice_' . $request->reservation_id . '.pdf',
            'pdfContent' => base64_encode($pdfContent),
        ]);
    }
}
