<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đặt bàn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .email-header {
            text-align: center;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .email-header h1 {
            font-size: 24px;
            color: #4caf50;
        }

        .email-body p {
            line-height: 1.6;
            font-size: 16px;
        }

        .email-body a {
            display: inline-block;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
        }

        .email-body a:hover {
            background-color: #43a047;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }

        .email-footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Xác nhận đặt bàn</h1>
        </div>
        <div class="email-body">
            <p>Chào bạn,</p>
            <p>Cảm ơn bạn đã đặt bàn tại nhà hàng của chúng tôi.</p>
            <p>Vui lòng nhấn vào đường link bên dưới để xác nhận đơn đặt bàn của bạn:</p>
            <a href="{{ $confirmationUrl }}">Xác nhận đặt bàn</a>
            <p>Nếu bạn không thực hiện hành động này, vui lòng bỏ qua email này.</p>
        </div>
        <div class="email-footer">
            <p>Trân trọng,</p>
            <p>Nhà hàng ABC</p>
        </div>
    </div>
</body>
</html>
