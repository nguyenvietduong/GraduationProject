<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; }
        .header, .footer { text-align: center; margin-top: 20px; }
        .qr-code { text-align: right; margin-top: 20px; }
    </style>
    <title>Invoice PDF</title>
</head>
<body>
    <!-- Thông tin website -->
    <div class="header">
        <h2>Your Website Name</h2>
        <p>Website: https://example.com</p>
    </div>

    <!-- Thông tin khách hàng -->
    <h3>Thông tin khách hàng</h3>
    <p>Tên khách hàng: </p>
    <p>Địa chỉ: </p>
    <p>Số điện thoại: </p>
    <!-- Chi tiết hóa đơn -->
    <h3>Chi tiết hóa đơn</h3>
    <table>
        <thead>
            <tr>
                <th>ID món</th>
                <th>Tên món</th>
                <th>Số lượng</th>
                <th>Đơn giá (VND)</th>
                <th>Thành tiền (VND)</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
        </tbody>
    </table>

    <!-- Tổng số tiền -->
    <h3 style="text-align: right;">Tổng số tiền:  VND</h3>

    <!-- Mã QR Code -->
    <div class="qr-code">
        <p>Quét mã QR để xem chi tiết hóa đơn hoặc thanh toán</p>
        <img src="data:image/png;base64," alt="QR Code">
    </div>

    <div class="footer">
        <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>
    </div>
</body>
</html>
