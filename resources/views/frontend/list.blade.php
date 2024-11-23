@extends('layout.frontend')
@section('contentUser')
    <style>
        <style>.custom-table-container {
            max-height: 400px;
            /* Chiều cao tối đa của bảng */
            overflow-y: auto;
            /* Hiển thị thanh cuộn theo chiều dọc */
            border: 1px solid #ddd;
            /* Đường viền để tạo cảm giác rõ ràng */
            border-radius: 8px;
            /* Bo góc (tuỳ chọn) */
        }

        table.table-auto {
            width: 100%;
            /* Đảm bảo bảng chiếm toàn bộ chiều rộng */
            border-collapse: collapse;
            /* Loại bỏ khoảng cách giữa các ô */
        }

        table.table-auto th,
        table.table-auto td {
            padding: 8px 16px;
            /* Khoảng cách giữa nội dung và đường viền */
            text-align: left;
            /* Căn trái */
            border-bottom: 1px solid #ddd;
            /* Đường kẻ dưới giữa các hàng */
        }

        table.table-auto th {
            background-color: #f4f4f4;
            /* Màu nền cho header */
            position: sticky;
            /* Sticky header */
            top: 0;
            /* Giữ header cố định */
        }
    </style>

    </style>
    <!-- Start Hero -->
    @include('frontend.component.breadcrumb', [
        ($titleHeader = 'Danh sách đơn hàng'),
        ($title = 'Danh sách đơn hàng'),
    ])

    <!-- End Hero -->

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="custom-table-container">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã hóa đơn</th>
                            <th>Thời gian đặt</th>
                            <th>Số người</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái đơn hàng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listReservation as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td> <!-- Thứ tự bắt đầu từ 1 -->
                                <td>{{ $value->code }}</td>
                                <td>{{ $value->reservation_time }}</td>
                                <td>{{ $value->guests }}</td>
                                <td>{{ $value->special_request }}</td>
                                <td>
                                    @foreach (__('messages.reservation.status') as $statusKey => $statusValue)
                                        @if ($statusKey == $value->status)
                                            {{ $statusValue }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <!-- Nội dung cho cột cuối (tuỳ chọn) -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- End -->
@endsection
