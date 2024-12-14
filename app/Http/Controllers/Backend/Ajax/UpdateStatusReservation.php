<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Mail\ReservationCancellationMail;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\ReservationConfirmed;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UpdateStatusReservation extends Controller
{
    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:reservations,id',
            'status' => 'required|in:pending,confirmed,arrived,canceled,completed',
        ]);
    
        $reservation = Reservation::find($data['id']);
    
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
    
        if ($reservation->status === $data['status']) {
            return response()->json(['message' => 'The status is already set to the requested value'], 200);
        }
    
        if ($reservation->status !== 'pending' && $data['status'] === 'canceled') {
            return response()->json(['message' => 'Cannot cancel a reservation that has already been confirmed!'], 400);
        }
    
        $reservation->status = $data['status'];
        $reservation->save();
    
        // Trả JSON response ngay lập tức
        $response = response()->json([
            'message' => 'Status updated successfully',
            'data' => $reservation,
        ]);
    
        // Đăng ký hàm gửi email trong `register_shutdown_function`
        register_shutdown_function(function () use ($reservation, $data) {
            if ($data['status'] === 'confirmed') {
                Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
            } elseif ($data['status'] === 'canceled') {
                Mail::to($reservation->email)->send(new ReservationCancellationMail($reservation));
            }
        });
    
        return $response;
    }    
    
    public function updateTableStatus(Request $request)
    {
        // dd(123123);
        $tables = $request->input('table_id'); // Nhận mảng từ request
        $reservationId = $request->input('reservation_id');
        $guest = $request->input('guest');

        // Kiểm tra nếu mảng bàn không rỗng
        if (!empty($tables)) {
            foreach ($tables as $table) {
                // Cập nhật trạng thái của từng bàn thành "selected"
                Table::where('id', $table['id'])->update(['status' => 'occupied']);

                ReservationDetail::create([
                    'reservation_id' => $reservationId,
                    'table_id' => $table['id'],
                    'guests_detail' => $guest,
                    'created_at' => Carbon::now()->timestamp,
                ]);
            }
        }




        return response()->json(['message' => 'Status updated successfully']);
    }

    public function getAvailableTables(Request $request)
    {
        $availableTables = Table::get(['id', 'name', 'capacity', 'status', 'description']);

        return response()->json(['tables' => $availableTables]);
    }

    public function getAvailableMenus(Request $request)
    {
        $key = $request->all();
        // dd($key);
        $search = $key['key'];

        $categories = Category::with([
            'menus' => function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                }
            }
        ])->get();
        // dd($categories);

        // Retrieve all active menus
        // $availableMenus = Menu::where('status', 'active')
        //     ->where('name', 'LIKE', '%' . $key['key'] . '%')->get();

        return response()->json(['menus' => $categories]);
    }

    public function getInvoiceItemData(Request $request)
    {
        $reservation_id = $request->input('reservation_id');
        $reservationDetail = ReservationDetail::where('reservation_id', $reservation_id)->get();
        $invoice = Invoice::where('reservation_id', $reservation_id)->first();

        if (!empty($invoice)) {

            $data = [
                'invoice_id' => $invoice->id,
                'reservation_id' => $reservation_id,
                'total_amount' => $invoice->total_amount ?? 0,
                'list_table' => [],
                'invoice_item' => [],
            ];

            foreach ($reservationDetail as $detail) {
                $data['list_table'][] = [
                    'id' => $detail->table_id,
                    'name' => $detail->table->name ?? 'Chưa có tên bàn',
                ];
            }

            if ($invoice && $invoice->invoiceItems) {
                foreach ($invoice->invoiceItems as $item) {
                    $data['invoice_item'][] = [
                        'id' => $item->menu_id,
                        'name' => $item->menu->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'total' => $item->quantity * $item->price,
                    ];
                }
            }
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    public function createInvoiceDataDetail(Request $request)
    {
        $data = $request->all();
    
        // Tạo hóa đơn mới
        $invoice = Invoice::create([
            'reservation_id' => $data['reservation_id'],
            'total_amount' => $data['total_amount'],
        ]);
    
        // Lặp qua danh sách bàn
        foreach ($data['list_table'] as $table) {
            // Kiểm tra xem bàn đã tồn tại trong chi tiết đặt bàn chưa
            $existingReservationDetail = ReservationDetail::where('reservation_id', $data['reservation_id'])
                ->where('table_id', $table['id'])
                ->first();
    
            if (!$existingReservationDetail) {
                // Nếu chưa có, thêm bàn vào chi tiết đặt bàn
                ReservationDetail::create([
                    'reservation_id' => $data['reservation_id'],
                    'table_id' => $table['id'],
                ]);
    
                // Cập nhật trạng thái bàn thành "đã có người ngồi"
                Table::where('id', $table['id'])->update(['status' => 'occupied']);
            }
        }
    
        // Lặp qua danh sách món ăn trong hóa đơn
        foreach ($data['invoice_item'] as $item) {
            Invoice_item::create([
                'invoice_id' => $invoice->id,
                'menu_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['total'],
            ]);
        }
    
        return response()->json(['success' => true, 'message' => 'Lưu dữ liệu thành công']);
    }    

    public function updateInvoiceDataDetail(Request $request)
    {
        $data = $request->all();
        $invoiceItems = $request->input('invoice_item', []);

        $invoice = Invoice::findOrFail($data['invoice_id']);

        $invoice->update(['total_amount' => $data['total_amount']]);

        $invoice->invoiceItems()->delete();

        foreach ($invoiceItems as $item) {
            $invoice->invoiceItems()->create([
                'invoice_id' => $data['invoice_id'],
                'menu_id' => $item['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Lưu dữ liệu thành công']);
    }

    public function createNewReservation(Request $request)
    {
        $data = $request->all();

        $data['reservation_time'] = Carbon::now()->timestamp;
        $data['created_at'] = Carbon::now()->timestamp;
        $data['updated_at'] = Carbon::now()->timestamp;

        $data['status'] = 'arrived';


        $reservation = Reservation::create($data);

        if ($reservation) {
            return response()->json([
                'flag' => true,
                'message' => 'Tạo đơn mới thành công!',
            ]);
        } else {
            return response()->json([
                'flag' => false,
                'message' => 'Tạo đơn mới thất bại!',
            ]);
        }
    }
}
