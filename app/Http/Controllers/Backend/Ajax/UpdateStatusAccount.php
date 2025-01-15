<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you're using the User model
use Illuminate\Support\Facades\DB;

class UpdateStatusAccount extends Controller
{
    public function updateStatus(Request $request)
    {
        // Validate input
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:users,id',
                'status' => 'required|string',
            ]);

            $status = $request->input('status');
            $id = $request->input('id');
            $reservationExist = Reservation::where('user_id', $id)
                ->latest()
                ->whereNotIn('status', ['canceled', 'completed'])
                ->exists();

            // Kiểm tra nếu người dùng đã đặt bàn thì không cho đổi trạng thái thành 'locked'
            if ($status == 'locked' && $reservationExist) {
                return response()->json([
                    'message' => 'Người dùng này đang có đơn đặt bàn, không thể đổi trạng thái.'
                ], 400);
            }

            // Cập nhật trạng thái người dùng
            User::where('id', $id)->update(['status' => $status]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
