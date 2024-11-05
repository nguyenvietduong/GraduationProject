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
        <h1>Hủy Đặt Bàn</h1>
        <p>Xin chào {{ $userName }},</p>
        <p>Chúng tôi rất tiếc phải thông báo rằng đơn đặt bàn của bạn vào lúc <strong>{{ $reservation_time }}</strong> đã bị hủy do bạn không đến trong khoảng thời gian quy định.</p>
        <p>Nếu bạn có bất kỳ thắc mắc nào hoặc cần hỗ trợ, xin vui lòng liên hệ với chúng tôi.</p>
        <p>Trân trọng,<br>Đội ngũ Nhà Hàng</p>
    </div>
</body>

</html>
