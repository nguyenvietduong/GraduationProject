<?php

namespace App\Http\Controllers\Backend\Promotion;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
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
    public function getDetailVoucher(Request $request){
        return  Promotion::where("code" , $request->get("code"))
        ->where("start_date" ,'<=', Carbon::now())
        ->where("end_date" ,'>', Carbon::now())
        ->where("is_active" ,'=', 1)
        ->where("total"  , '>' , 0 )
        ->where("min_order_value"  , "<=" ,  $request->query("totalAmount"))
        ->get();
    }
}
