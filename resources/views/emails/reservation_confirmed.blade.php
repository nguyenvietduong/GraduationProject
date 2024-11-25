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
        @if (App::getLocale() == 'vi')
        <h1>Xác Nhận Đặt Bàn</h1>
        <p>Chào {{ $reservation->name }}, đặt bàn lúc <strong>{{ $reservation->reservation_time }}</strong> của quý khách đã được xác nhận.</p>
        <p>Mã đơn hàng: <strong style="color: red">{{ $reservation->code }}</strong></p>
        <p>Rất mong được phục vụ quý khách!</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @else
        <h1>Reservation Confirmation</h1>
        <p>Hello {{ $reservation->name }}, your table reservation at <strong>{{ $reservation->reservation_time }}</strong> has been confirmed.</p>
        <p>We look forward to serving you!</p>
        <p>Sincerely,<br>The Restaurant Team</p>
        @endif
    </div>
</body>

</html>