<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đặt Bàn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #4CAF50;
            font-size: 24px;
            text-align: center;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        @if ($reservation->status == 'pending')
        <h1>Xác Nhận Đặt Bàn</h1>
        <p>Chào {{ $reservation->name }}</p>
        <p>Chúng tôi đã nhận được đơn đặt bàn vào lúc <strong>{{ formatDate($reservation->reservation_time) }}</strong> của quý khách.</p>
        <p>Bộ phận chăm sóc khách hàng sẽ sớm liên hệ lại để hỗ trợ thêm thông tin. Sau khi xác nhận chúng tôi sẽ thông báo lại!</p>
        <p>Chúng tôi rất mong được phục vụ quý khách tại nhà hàng của chúng tôi!</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @elseif ($reservation->status == 'confirmed')
        <h1>Xác Nhận Đơn Đặt Bàn</h1>
        <p>Chào {{ $reservation->name ?? '' }}</p>
        <p>Đơn đặt bàn của quý khách đã được xác nhận thành công.</p>
        <p>Mã xác nhận của quý khách là: <strong style="color: red">{{ $reservation->code }}</strong>.</p>
        <h3 style="margin-top: 20px; color: #333;">Thông Tin Đặt Bàn:</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Thông Tin</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Chi Tiết</th>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">Tên đơn hàng</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->name ?? '' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">Số Điện Thoại</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->phone }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">Số Khách</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->guests }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">Thông tin ngày đặt</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ formatDate($reservation->reservation_time) }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">Mã đơn hàng</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->code }}</td>
            </tr>      
        </table>
        <p>Chúng tôi hân hạnh được chào đón quý khách đến với nhà hàng!</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @elseif ($reservation->status == 'completed') 
        <div style="font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px; padding: 20px;">
            <h1 style="text-align: center; color: #4CAF50;">Cảm Ơn Quý Khách</h1>
            <p>Chào <strong>{{ $reservation->name ?? '' }}</strong>,</p>
            <p>Đơn đặt bàn của quý khách vào lúc <strong>{{ formatDate($reservation->reservation_time) }}</strong> đã được hoàn tất và thanh toán thành công.</p>
            <p>Mã xác nhận của quý khách là: <strong style="color: red">{{ $reservation->code }}</strong>.</p>
            
            <h3 style="margin-top: 20px; color: #333;">Thông Tin Đặt Bàn:</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Thông Tin</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Chi Tiết</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Tên Khách</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->name ?? '' }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Số Điện Thoại</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->phone }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Số Khách</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->guests }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Thông tin ngày đặt</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ formatDate($reservation->reservation_time) }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Mã đơn hàng</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reservation->code }}</td>
                </tr>         
            </table>
        
            <h3 style="margin-top: 20px; color: #333;">Danh Sách Món Ăn:</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Tên Món Ăn</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Số Lượng</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Giá</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Thành Tiền</th>
                </tr>
                @php
                    $totalCount = 0;
                @endphp
                @foreach ($reservation->invoice->invoiceItems as $dish)
                @php
                    $totalCount += $dish->price;
                @endphp
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $dish->menu_name }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $dish->quantity }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">{{ number_format($dish->price, 0, ',', '.') }} đ</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">{{ number_format($dish->quantity * $dish->price, 0, ',', '.') }} đ</td>
                </tr>
                @endforeach
                @if ($reservation->invoice->promotionDetail)
                    <tr>
                        <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">Mã giảm giá: <span style="color: red">{{ $reservation->invoice->promotionDetail->promotion->code }}</span></td>
                        @php
                            
                        @endphp
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">{{ number_format($totalCount - $reservation->invoice->total_amount, 0, ',', '.') }} đ</td>
                    </tr>
                @endif
                
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">Tổng Cộng:</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">{{ number_format($reservation->invoice->total_amount, 0, ',', '.') }} đ</td>
                </tr>
            </table>
        
            <p style="margin-top: 20px;">Chúng tôi hy vọng sẽ tiếp tục được phục vụ quý khách trong tương lai!</p>
            <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        </div>        
        @endif
    </div>
</body>

</html>
