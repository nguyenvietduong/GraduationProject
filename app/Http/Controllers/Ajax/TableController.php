<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TableController extends Controller
{


    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $requestData = $request->all();
        $validator = \Validator::make(
            $requestData,
            [
                'id' => 'required',
                'status' => 'required'
            ]
        );
        if ($validator->fails())
            return response()->json(['status' => false, 'errors' => $validator->errors()->all()]);

        $checkStatusInvoice = Invoice::whereHas('reservation.ReservationDetails.table', function ($query) use($id) {
            $query->where('id', $id); 
        })->where('status', 'unpaid') // Kiểm tra trạng thái hóa đơn 
            ->get();
            // dd(count($checkStatusInvoice));
            
        if(count($checkStatusInvoice) > 0)
            return response()->json(['status' => false, 'errors' => 'Bàn đang có người sử dụng!']);
        

        try {
            $table = Table::find($id);
            if (!$table)
                return response()->json(['status' => false, 'errors' => 'Table not found']);
            $table->update([
                'status' => $request->status ?? 'available'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Update table success',

            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errors' => $e->getMessage()]);
        }
    }

}
