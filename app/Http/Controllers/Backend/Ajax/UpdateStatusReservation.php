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
        // Validate input
        $data = $request->all();
        // dd($data);
        // Find the reservation by ID
        $reservation = Reservation::find($data['id']);

        if (!$reservation) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the status
        $reservation->status = $request->status;
        $reservation->save();

        if ($reservation->status == 'confirmed') {
            // Send confirmation email
            Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
        } else if ($reservation->status == 'canceled') {
            Mail::to($reservation->email)->send(new ReservationCancellationMail($reservation));
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $reservation
        ]);
    }

    public function updateTableStatus(Request $request)
    {
        // dd(123123);
        $tables = $request->input('table_id'); // Nhận mảng từ request
        $reservationId = $request->input('reservation_id');
        $guest = $request->input('guest');

        if (!empty($tables)) {
            foreach ($tables as $table) {
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

        $invoice = Invoice::create([
            'reservation_id' => $data['reservation_id'],
            'total_amount' => $data['total_amount'],
        ]);

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
                'total' => $item['total']
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Lưu dữ liệu thành công']);
    }

    public function createNewReservation(Request $request)
    {
        $data = $request->all();

        dd($data);
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
