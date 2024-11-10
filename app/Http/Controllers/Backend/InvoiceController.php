<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Reservation;
use App\Models\Restaurant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                foreach ($request->invoice_item as $data) {
                    Invoice_item::create([
                        'invoice_id' => $invoice->id,
                        'menu_id' => $data['id'],
                        'quantity' => $data['quantity'],
                        'price' => $data['price'],
                        'total' => $data['total']
                    ]);
                }
            });
            return response()->json(['success' => 'Thêm mới thành công']);
        } catch (\Throwable $th) {
        }
    }
    public function exportAndSavePDF(Request $request)
    {
        // Lấy dữ liệu từ request
        $data = $request->all();
        $res = Restaurant::first();
        // Tạo file PDF từ view với dữ liệu truyền vào
        $pdf = Pdf::loadView('backend.reservation.invoice_pdf', $data);

        // Tên file PDF và đường dẫn lưu trữ
        $fileName = 'invoice_' . time() . '.pdf';
        $filePath = 'public/invoices/' . $fileName;  // Sử dụng 'public/' để lưu trong thư mục storage/app/public

        // Lưu file PDF vào storage
        Storage::put($filePath, $pdf->output());

        // Trả về URL của file PDF đã lưu
        $fileUrl = Storage::url($filePath);

        return response()->json([
            'success' => true,
            'file_url' => $fileUrl  // URL để tải hoặc xem file PDF
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
