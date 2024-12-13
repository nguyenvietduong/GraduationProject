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
        <p>Chào {{ $reservation->name }}, chúng tôi đã nhận được đơn đặt bàn vào lúc <strong>{{ $reservation->reservation_time }}</strong> của quý khách.</p>
        <p>Bộ phận chăm sóc khách hàng sẽ sớm liên hệ lại để hỗ trợ thêm thông tin.</p>
        <p>Chúng tôi rất mong được phục vụ quý khách tại nhà hàng của chúng tôi!</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @elseif ($reservation->status == 'confirmed')
        <h1>Xác Nhận Đơn Đặt Bàn</h1>
        <p>Chào {{ $reservation->name }}, đơn đặt bàn của quý khách vào lúc <strong>{{ $reservation->reservation_time }}</strong> đã được xác nhận thành công.</p>
        <p>Mã xác nhận của quý khách là: <strong style="color: red">{{ $reservation->code }}</strong>.</p>
        <p>Chúng tôi hân hạnh được chào đón quý khách đến với nhà hàng!</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @elseif ($reservation->status == 'completed') 
        <h1>Cảm Ơn Quý Khách</h1>
        <p>Chào {{ $reservation->name }}, đơn đặt bàn của quý khách vào lúc <strong>{{ $reservation->reservation_time }}</strong> đã được hoàn tất và thanh toán thành công.</p>
        <p>Mã xác nhận của quý khách là: <strong style="color: red">{{ $reservation->code }}</strong>.</p>
        <p>Chúng tôi hy vọng sẽ tiếp tục được phục vụ quý khách trong tương lai!</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @endif
    </div>
</body>

</html>
