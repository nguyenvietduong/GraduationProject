<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\PromotionUser;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data = [];
        $reservation = Reservation::with("reservationDetails.table")->find($id);
        $invoice = Reservation::find($id)->invoice()->with([
            'invoiceItems.menu' => function ($query) {
                $query->select('id', 'name', 'price');
            }
        ])->first();
        $data["reservation"] = $reservation;
        $data["invoice"] = $invoice;

        // dd($data);

        return $data;
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

    public function vnpay_payment(Request $request)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url("/vnpay/callback");
        $vnp_TmnCode = "TW34Y9EQ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "OX5R6KHM3F5G4KHAD5J8MQAUA66YWFJV"; //Chuỗi bí mật

        $vnp_TxnRef = $request->code . "-" . time() . "-" . $request->voucher; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY

        $vnp_OrderInfo = "Thanh toán VNPay";
        $vnp_OrderType = "billpayment";

        $total_amount = $request->total_amount;
        if (isset($request->voucher)) {
            $promotion = Promotion::where('code', $request->voucher)->first();
            if (isset($promotion) && $request->total_amount > $promotion->min_order_value) {
                if ($promotion->type == 'fixed') {
                    $total_amount = $request->total_amount - $promotion->discount;
                } else {
                    if (($total_amount * $promotion->discount) / 100 > $promotion->max_discount) {
                        $total_amount = $request->total_amount - $promotion->max_discount;
                    } else {
                        $total_amount = $request->total_amount - ($request->total_amount * $promotion->discount) / 100;
                    }
                }
            }
        }

        $vnp_Amount = $total_amount * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $reservation = Reservation::find($request->id); // Lấy đơn hàng theo id
        if (!$reservation) {
            return redirect()->route('reservation.list')->with('error', 'Đơn hàng không tồn tại!');
        }

        if ($reservation->status === 'completed' && $reservation->invoice->status === 'paid') {
            return redirect()->route('reservation.list')->with('error', 'Đơn hàng đã được thanh toán!');
        }

        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
    public function handlePaymentReturn(Request $request)
    {
        $vnp_HashSecret = "OX5R6KHM3F5G4KHAD5J8MQAUA66YWFJV"; // Chuỗi bí mật của bạn
        $inputData = $request->all();
        // Xác thực chữ ký
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] === '00') {
                // Giao dịch thành công

                // Lấy phần đầu (trước dấu cách đầu tiên)
                $code_reservation = strstr($inputData['vnp_TxnRef'], '-', true);
                // Lấy phần cuối (sau dấu cách cuối cùng)
                $voucher = substr(strrchr($inputData['vnp_TxnRef'], '-'), 1);
                if ($voucher != "") {
                    $promotion = Promotion::where('code', $voucher)->first();
                }
                $reservation = Reservation::where('code', $code_reservation)->first();
                // dd($code_reservation, $promotion ?? "",$reservation->invoice->id);
                $reservation->update(['status' => 'completed']);
                $reservation->invoice()->update(['status' => 'paid', 'payment_method' => 'bank' , 'total_amount' => $inputData['vnp_Amount']/100]);
                foreach ($reservation->reservationDetails as $data) {
                    Table::where('id', $data->table_id)->update([
                        'status' => "available",
                    ]);
                }
                if (isset($promotion) && $reservation->invoice->total_amount > $promotion->min_order_value) {
                    PromotionUser::create([
                        'promotion_id' => $promotion->id,
                        'invoice_id' => $reservation->invoice->id,
                    ]);
                }
                return redirect()->route('reservation.list')->with('success', 'Thanh toán thành công!');
            } else {
                // Giao dịch thất bại
                return redirect()->route('reservation.list')->with('error', 'Thanh toán thất bại!');
            }
        } else {
            return redirect()->route('reservation.list')->with('error', 'Thanh toán thất bại 2!');
        }
    }
}
