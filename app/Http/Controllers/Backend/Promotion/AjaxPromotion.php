<?php

namespace App\Http\Controllers\Backend\Promotion;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\PromotionUser;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class AjaxPromotion extends Controller
{
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $promotion = Promotion::find($data['dataPromotion']);
        $promotion->is_active = $data['value'];
        $promotion->save();
        $currentDateTime = Carbon::now()->format('d/m/Y H:i:s');
        return [
            'response' => response()->json(['message' => 'Status updated successfully']),
            'updateTime' => $currentDateTime
        ];
    }
    public function getDetailVoucher(Request $request)
    {
        // Lấy thông tin mã giảm giá
        $promotion = Promotion::where("id", $request->get("id"))
            ->where("start_date", "<=", Carbon::now())
            ->where("end_date", ">", Carbon::now())
            ->where("is_active", 1)
            ->first();

        if (!$promotion) {
            // Mã giảm giá không tồn tại hoặc không hợp lệ
            return response()->json([
                'message' => 'Mã giảm giá không tồn tại hoặc không hợp lệ.',
                'data' => null
            ]);
        }

        // Đếm số lượng người dùng đã sử dụng mã
        $count = PromotionUser::where("promotion_id", $promotion->id)->count();

        // Kiểm tra các điều kiện bổ sung
        if (
            $promotion->total > $count && // Tổng số mã chưa bị vượt quá
            $promotion->min_order_value <= $request->query("totalAmount") // Giá trị đơn hàng tối thiểu
        ) {
            // Mã hợp lệ
            return response()->json([
                'message' => 'Mã giảm giá hợp lệ.',
                'data' => $promotion
            ]);
        }

        // Mã giảm giá không thỏa mãn điều kiện
        return response()->json([
            'message' => 'Mã giảm giá không thỏa mãn điều kiện sử dụng.',
            'data' => null
        ]);
    }
    public function searchVoucher(Request $request)
    {
        return  Promotion::where(function ($query) use ($request) {
            $query->where('code', $request->get("code"))
                ->orWhere('title', 'LIKE', '%' . $request->get("code") . '%');
        })
            ->where("start_date", '<=', Carbon::now())
            ->where("end_date", '>', Carbon::now())
            ->where("is_active", '=', 1)
            ->with("promotionUsers")
            ->take(3)
            ->get();
    }
    public function getAllVoucher(Request $request)
    {
        return  Promotion::where("start_date", '<=', Carbon::now())
            ->where("end_date", '>', Carbon::now())
            ->where("is_active", '=', 1)
            ->with("promotionUsers")
            ->take(3)
            ->get();
    }
}
