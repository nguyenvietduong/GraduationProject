<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hủy Đặt Bàn</title>
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
            color: #FF5733;
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
        <h1>Hủy Đặt Bàn</h1>
        <p>Xin chào {{ $reservation['name'] }},</p>
        <p>Chúng tôi xin thông báo rằng đơn đặt bàn của quý khách vào lúc <strong>{{ $reservation['input-time'] }}</strong> ngày <strong>{{ $reservation['date'] }}</strong> đã bị hủy do không còn đủ bàn vào thời gian đó.</p>
        <p>Rất tiếc vì sự bất tiện này. Nếu cần hỗ trợ, xin vui lòng liên hệ với chúng tôi.</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
        @else
        <h1>Reservation Cancellation</h1>
        <p>Hello {{ $reservation['name'] }},</p>
        <p>We regret to inform you that your table reservation at <strong>{{ $reservation['input-time'] }}</strong> on <strong>{{ $reservation['date'] }}</strong> has been canceled due to the unavailability of tables at that time.</p>
        <p>We apologize for the inconvenience. If you need assistance, please feel free to contact us.</p>
        <p>Sincerely,<br>The Restaurant Team</p>
        @endif
    </div>
</body>

</html>