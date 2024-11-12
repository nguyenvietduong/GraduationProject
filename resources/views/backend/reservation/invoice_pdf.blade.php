<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        .header,
        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code {
            text-align: right;
            margin-top: 20px;
        }
    </style>
    <title>Invoice PDF</title>
</head>

<body>
    <!-- Thông tin website -->
    <div class="header">
        <h2>{{ $res->name }}</h2>
        <p> Hóa đơn thanh toán </p>
    </div>
    <hr>
    <!-- Thông tin khách hàng -->
    <h3>Thông tin khách hàng</h3>
    <p>Tên khách hàng: {{ $reservation->name }}</p>
    <p>Số điện thoại: {{ $reservation->phone }}</p>
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
            {{ $total_amount=0 }}
            @foreach ($invoice_item as $key => $item)
                {{ $total_amount += $item['price'] }}
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price']) }}</td>
                    <td>{{ number_format($item['total']) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Tổng Tiền:</strong></td>
                <td><strong>{{ number_format($total_amount) }} VND</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Tổng số tiền -->
    <h3 style="text-align: right;">Giảm giá: {{ number_format($voucher_discount) }} VND</h3>
    <h3 style="text-align: right;">Tổng số tiền: {{ number_format($total_payment) }} VND</h3>

    <!-- Mã QR Code -->
    <div class="qr-code">
        <p>Quét mã QR để xem chi tiết hóa đơn hoặc thanh toán</p>
        <img src="{{ asset('storage/qrcode_images/qrcode.jpg') }}" alt="QR Code" style="width: 150px;">
    </div>

    <div class="footer">
        <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>
    </div>
</body>

</html>
