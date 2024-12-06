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

        if ($invoice->id) {
            $invoiceItem = Invoice_item::where('invoice_id', $invoice->id)->get();
        }

        dd($invoice);
    }

    public function updateInvoiceDataDetail(Request $request){
        $data = $request->all();
        dd($data);
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
