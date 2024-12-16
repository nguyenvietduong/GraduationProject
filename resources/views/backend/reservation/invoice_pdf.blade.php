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
        <h2>{{ $reservation->code }}</h2>
        <p> Hóa đơn thanh toán </p>
    </div>
    <hr>
    <!-- Thông tin khách hàng -->
    <h3>Thông tin khách hàng</h3>
    <p>Tên khách hàng: {{ $reservation->name }}</p>
    <p>Số điện thoại: {{ $reservation->phone }}</p>
    <p>Thời gian đặt chỗ: {{ $reservation->reservation_time }}</p>
    <!-- Chi tiết hóa đơn -->
    <h3>Chi tiết hóa đơn</h3>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên món</th>
                <th>Số lượng</th>
                <th>Thành tiền (VND)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount=0
            @endphp
            @foreach ($reservation->invoice->invoiceItems as $key => $item)
                {{ $total_amount += ($item->price * $item->quantity) }}
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['menu']['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity']) }} đ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Tổng hóa đơn</strong></td>
                <td><strong>{{ number_format($total_amount) }} đ</strong></td>
            </tr>
            @php
            $totalCount = 0;
            @endphp
            @foreach ($reservation->invoice->invoiceItems as $dish)
            @php
                $totalCount += $dish->price;
            @endphp
            @endforeach
            @if ($reservation->invoice->promotionDetail)
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Giảm giá:</strong></td>
                    <td><strong>{{ number_format($totalCount, 0, ',', '.') }} đ</strong></td>
                </tr>
            @endif
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Thành tiền:</strong></td>
                <td><strong>{{ number_format($totalCount - $reservation->invoice->total_amount, 0, ',', '.') }} đ</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>
    </div>
</body>

</html>
