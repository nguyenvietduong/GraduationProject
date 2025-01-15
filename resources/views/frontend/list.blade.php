@extends('layout.frontend')
@section('contentUser')
    <!-- Custom Styles -->
    <style>
        .custom-table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        table.table-auto {
            width: 100%;
            border-collapse: collapse;
        }

        table.table-auto th,
        table.table-auto td {
            padding: 8px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table.table-auto th {
            background-color: #f4f4f4;
            position: sticky;
            top: 0;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            /* Covers the entire viewport */
            background: rgba(0, 0, 0, 0.75);
            /* Semi-transparent black background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
            /* Above other content */
        }

        /* Modal Content */
        .modal-content {
            transform: scale(0.95);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
            max-height: 400px;
            overflow-y: auto;
        }

        .modal-content:not(.hidden) {
            transform: scale(1);
            opacity: 1;
        }

        /* Prevent Scrolling When Modal is Active */
        body.modal-open {
            overflow: hidden;
        }

        .stars {
            display: flex;
            flex-direction: row-reverse;
            /* Đảo ngược thứ tự hiển thị */
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
            margin: auto;
        }

        .stars input {
            display: none;
            /* Ẩn các ô input */
        }

        .stars label {
            font-size: 2rem;
            /* Kích thước sao */
            color: gray;
            /* Màu sao không chọn */
            cursor: pointer;
            /* Con trỏ khi di chuột vào sao */
            transition: color 0.2s;
            /* Hiệu ứng chuyển màu mượt mà */
        }

        /* Tô màu vàng cho tất cả các sao bên trái đã chọn */
        .stars input:checked~label {
            color: gold;
            /* Màu vàng cho các sao đã chọn bên trái */
        }

        /* Tô màu vàng cho sao đã chọn */
        .stars input:checked+label {
            color: gold;
            /* Màu vàng cho sao đã chọn */
        }

        /* Tô màu vàng khi hover và tất cả các sao bên trái */
        .stars label:hover,
        .stars label:hover~label {
            color: gold;
            /* Màu vàng khi di chuột vào sao */
        }

        /* Tô màu vàng cho tất cả các sao đã chọn khi hover */
        .stars input:checked+label:hover,
        .stars input:checked+label:hover~label {
            color: gold;
            /* Màu vàng cho tất cả các sao đã chọn */
        }

        /* Khi hover vào label thì tô màu vàng cho tất cả các sao bên trái */
        .stars label:hover {
            color: gold;
            /* Màu vàng khi hover */
        }

        .error-container {
            background-color: #f8d7da;
            /* Màu nền đỏ nhạt */
            border: 1px solid #f5c6cb;
            /* Đường viền đỏ */
            color: #721c24;
            /* Màu chữ đỏ đậm */
            padding: 10px;
            /* Đệm bên trong */
            margin-bottom: 20px;
            /* Khoảng cách dưới */
            border-radius: 4px;
            /* Bo góc */
        }

        .error-container ul {
            list-style-type: disc;
            /* Dấu chấm tròn cho danh sách */
            padding-left: 20px;
            /* Khoảng cách bên trái cho danh sách */
        }

        .error-container li {
            margin: 5px 0;
            /* Khoảng cách giữa các mục danh sách */
        }

        .hidden {
            display: none;
        }
    </style>

    @include('frontend.component.breadcrumb', [
        ($titleHeader = 'Lịch sử đặt bàn'),
        ($title = 'Lịch sử đặt bàn'),
    ])

    <!-- Reservation Table -->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="">
                <form method="get" action="" id="form_filter" class="space-y-4">
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <div class="flex flex-wrap items-center gap-4">
                            <!-- Status Dropdown -->
                            <div class="w-full md:w-auto">
                                <select name="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Trạng thái</option>
                                    @php
                                        $status = request('status') ?: old('status');
                                        $statuses = __('messages.reservation.status');
                                    @endphp
                                    @foreach ($statuses as $key => $option)
                                        <option value="{{ $key }}" {{ $status == $key ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Search Input -->
                            <div class="w-full md:flex-1">
                                <input type="text" id="search" name="keyword" placeholder="Tìm kiếm..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    value="{{ request('keyword') ?: old('keyword') }}">
                            </div>

                            <!-- Buttons -->
                            <div class="w-full md:flex-1">
                                <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none"
                                    style="background-color: #008000; padding: 5px; border-radius: 5px;color: white"> <i
                                        class="iconoir-filter-alt mr-2"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="custom-table-container">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th>#</th>
                            <th>Mã đơn đặt</th>
                            <th>Thời gian đặt</th>
                            <th>Số người</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái đơn hàng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($listReservation) && is_object($listReservation) && $listReservation->isNotEmpty())
                            @foreach ($listReservation as $key => $value)
                                <tr class="hover:bg-gray-50">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->reservation_time }}</td>
                                    <td>{{ $value->guests }}</td>
                                    <td>{{ $value->special_request }}</td>
                                    <td id="statusReservation-{{ $value->id }}">
                                        @foreach (__('messages.reservation.status') as $statusKey => $statusValue)
                                            @if ($statusKey == $value->status)
                                                {{ $statusValue }}
                                            @endif
                                        @endforeach
                                    </td>
                                    @if ($value->status == 'completed' || $value->status == 'arrived')
                                        <td class="text-center">
                                            <button class="text-blue-500 hover:text-blue-700 focus:outline-none"
                                                style="background-color: #008000; padding: 5px; border-radius: 5px;color: white"
                                                onclick="toggleModal('{{ $value->id }}')">
                                                Xem chi tiết
                                            </button>
                                        </td>
                                    @elseif ($value->status == 'pending')
                                        <td class="text-center">
                                            <button class="text-blue-500 hover:text-blue-700 focus:outline-none"
                                                style="background-color: #333366; padding: 5px; border-radius: 5px;color: white"
                                                id="btn-canceled-{{ $value->id }}"
                                                onclick="cancelReservation('{{ route('reservation.canceled', $value->id) }}', {{ $value->id }})">
                                                Hủy đơn đặt bàn
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>


                <!-- Modals -->
                @foreach ($listReservation as $value)
                    <div id="modal-{{ $value->id }}"
                        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg" style="width: 1300px;min-height: 450px">
                            <div class="flex justify-between items-center p-4 border-b">
                                <h2 class="text-lg font-semibold">Chi tiết đơn đặt bàn - {{ $value->code }}</h2>

                                <button class="text-gray-500 hover:text-gray-700"
                                    onclick="toggleModal('{{ $value->id }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="p-4 modal-content">
                                <!-- Second Column -->
                                @if ($value->reservationDetails && $value->status != 'confirmed')
                                    <div>
                                        <p class="mt-2"><strong>Thông tin người đặt:</strong>
                                            ({{ $value->name . ' - ' . $value->phone . ' - ' . $value->email }})
                                        <p class="mt-2">
                                            <strong>Bàn đã ngồi:</strong>
                                            @foreach ($value->reservationDetails as $reservationDetail)
                                                @if ($reservationDetail->table)
                                                    ({{ $reservationDetail->table->name }})
                                                @else
                                                    Không có thông tin bàn
                                                @endif
                                            @endforeach
                                        </p>

                                        <p class="mt-2"><strong>Hình thức trả tiền:</strong>
                                            @foreach (__('messages.invoice.payment_method') as $paymentMethodKey => $paymentMethodValue)
                                                @if (($value->invoice ? $value->invoice->payment_method : '') == $paymentMethodKey)
                                                    {{ $paymentMethodValue }}
                                                @endif
                                            @endforeach
                                            @foreach (__('messages.invoice.status') as $statusKey => $statusValue)
                                                @if (($value->invoice ? $value->invoice->status : '') == $statusKey)
                                                    <span class="badge text-bg-success"
                                                        style="background-color: rgb(114, 228, 158);border-radius: 10px;padding-top: 3px;padding-left: 5px;padding-right: 5px;padding-bottom: 3px">({{ $statusValue }})</span>
                                                @endif
                                            @endforeach
                                        </p>
                                        <p class="mt-2">
                                            <strong class="text-lg font-semibold">Đánh giá của bạn: </strong>
                                            @if ($value->invoice && $value->invoice->review)
                                                <div class="mt-2">
                                                    <div class="flex items-center">
                                                        <span class="text-sm font-medium text-gray-700">Số điểm: </span>
                                                        <span class="ml-2 text-yellow-500 text-lg">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $value->invoice->review->rating)
                                                                    ★
                                                                @else
                                                                    ☆
                                                                @endif
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <div class="mt-1">
                                                        <span class="text-sm font-medium text-gray-700">Nội dung: </span>
                                                        <span
                                                            class="text-sm text-gray-600">{{ $value->invoice->review->comment ? $value->invoice->review->comment : 'Chưa có nội dung đánh giá.' }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-500">Chưa có đánh giá</span>
                                            @endif
                                        </p>
                                        <p class="mt-2"><strong>Danh sách thực đơn</strong>
                                        <table class="table-auto w-full border-collapse border border-gray-300">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th>#</th>
                                                    <th>Tên món</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá món</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php($totalAmountPayable = 0)
                                                @foreach ($value->invoice->invoiceItems ?? [] as $keyInvoices => $valueInvoice)
                                                    <tr class="hover:bg-gray-50">
                                                        <td>{{ $keyInvoices + 1 }}</td>
                                                        <td>{{ $valueInvoice->menu_name ?? 'N/A' }}</td>
                                                        <td>{{ $valueInvoice->quantity }}</td>
                                                        <td>{{ formatCurrency($valueInvoice->price) }} đ</td>
                                                        <td>{{ formatCurrency($valueInvoice->quantity * $valueInvoice->price) }}
                                                            đ</td>
                                                    </tr>

                                                    @php($totalAmountPayable += $valueInvoice->quantity * $valueInvoice->price)
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                @if ($value->status && $value->status == 'completed')
                                                    <tr>
                                                        <td colspan="4" style="text-align: center">Tổng tiền món ăn</td>
                                                        <td>{{ formatCurrency($totalAmountPayable) }} đ</td>
                                                    </tr>
                                                    <tr style="background-color: #98FB98">
                                                        <td colspan="4" style="text-align: center">Tổng thanh toán</td>
                                                        <td>{{ formatCurrency($value->invoice->total_amount) }} đ</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="4" style="text-align: center">Tổng tiền món ăn</td>
                                                        <td>{{ formatCurrency($totalAmountPayable) }} đ</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td colspan="4" style="text-align: center"><input type="text" name="" id="" placeholder="Nhập mã giảm giá" style="border: 1px solid black; padding-left: 5px; border-radius: 5px"> <input type="button" value="Tìm" style="padding: 2px;background-color: #008000;border-radius: 5px"></td>
                                                        <td>- đ</td>
                                                    </tr> --}}
                                                    <tr style="background-color: #98FB98">
                                                        <td colspan="4" style="text-align: center">Tổng tiền phải trả
                                                        </td>
                                                        <td id="totalAmountPayable">
                                                            {{ formatCurrency($totalAmountPayable) }} đ</td>
                                                    </tr>
                                                @endif
                                            </tfoot>
                                        </table>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            @if ($value->status && $value->status == 'completed')
                                @if ($value->invoice && is_null($value->invoice->review))
                                    <div class="flex justify-end p-4 border-t">
                                        <button
                                            style="background-color: #00ffea;color: white;border: none;border-radius: 5px;padding: 10px 20px;font-size: 16px;cursor: pointer;transition: background-color 0.3s, transform 0.2s;"
                                            onclick="toggleModalEvaluate('{{ $value->id }}')"
                                            onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';"
                                            onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';">
                                            Đánh giá ngay
                                        </button>
                                    </div>
                                @endif
                            @elseif($value->status && $value->status == 'arrived')
                                <div class=" p-4 border-t">
                                    <form action="{{ route('vnpay_payment') }}" method="post" class="flex justify-between ">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <input type="hidden" name="code" value="{{ $value->code }}">
                                        <input type="hidden" name="total_amount" value="{{ $totalAmountPayable }}">
                                        <div class="mb-4">
                                            <input type="text" id="voucher" name="voucher"
                                                class="mt-2 p-2 border border-gray-300 rounded w-full"
                                                placeholder="Nhập mã giảm giá">
                                        </div>
                                        <div class="mb-4">
                                            <button
                                            style="background-color: #007bff;color: white;border: none;border-radius: 5px;padding: 10px 20px;font-size: 16px;cursor: pointer;transition: background-color 0.3s, transform 0.2s;"
                                            name="redirect"
                                            onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';">
                                            Thanh toán ngay
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                {{-- Modal đánh giá --}}
                @foreach ($listReservation as $value)
                    <div id="modalEvaluate-{{ $value->id }}"
                        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg w-1/2">
                            <div class="flex justify-between items-center p-4 border-b">
                                <h2 class="text-lg font-semibold">Đánh giá - ({{ $value->code }})</h2>
                                <button class="text-gray-500 hover:text-gray-700"
                                    onclick="toggleModalEvaluate('{{ $value->id }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <form method="post" name="myForm" id="myForm" onsubmit="return validateForm()">
                                    @csrf
                                    <p class="mb-0" id="error-msg"></p>
                                    <div id="simple-msg"></div>
                                    <div class="grid lg:grid-cols-12 gap-4">
                                        <div class="col-span-12">
                                            <input type="hidden" name="id" value="{{ $value->id ?? '' }}">
                                            <input type="hidden" name="invoice_id"
                                                value="{{ $value->invoice->id ?? '' }}">
                                            <label for="subject">Điểm đánh giá</label>
                                            <div class="stars">
                                                <input type="radio" id="star5" name="rating" value="5" />
                                                <label for="star5" class="star">★</label>
                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label for="star4" class="star">★</label>
                                                <input type="radio" id="star3" name="rating" value="3"
                                                    checked />
                                                <label for="star3" class="star">★</label>
                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label for="star2" class="star">★</label>
                                                <input type="radio" id="star1" name="rating" value="1" />
                                                <label for="star1" class="star">★</label>
                                            </div>
                                        </div>

                                        <div class="col-span-12">
                                            <label for="comment">Đánh giá của bạn
                                                <span style="color: red">*</span></label>
                                            <textarea name="comment" id="comment"
                                                class="w-full py-2 px-3 h-28 bg-white dark:bg-slate-900 dark:text-slate-200 rounded-md shadow-sm border border-gray-300 dark:border-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                placeholder="Vui lòng nhập đánh giá của bạn"></textarea>
                                        </div>

                                        <div class="col-span-12">
                                            <button type="submit" id="submit" name="send"
                                                class="submitFormContact py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full">Đánh
                                                giá</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $listReservation->links('pagination::tailwind') }}
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        function toggleModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            const body = document.body;

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                body.classList.add('modal-open');
            } else {
                modal.classList.add('hidden');
                body.classList.remove('modal-open');
            }
        }

        function cancelReservation(url, id) {
            let confirmCancel = confirm('Bạn có chắc chắn không?');

            if (confirmCancel) {
                let btnCancel = $(`#btn-canceled-${id}`);
                let statusReservation = $(`#statusReservation-${id}`);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            btnCancel.addClass('hidden');
                            statusReservation.html('Đã hủy');
                            alert('Hủy đơn đặt bàn thành công');
                        } else if (response.success = 'false') {
                            alert(123);
                        }
                    },
                    error: function(response) {
                        btnCancel.addClass('hidden');
                        let text = null;
                        if (response.responseJSON.data == 'confirmed') {
                            text = 'Xác nhận'
                        } else if (response.responseJSON.data == 'arrived') {
                            text = 'Đã đến cửa hàng';
                        } else if (response.responseJSON.data == 'completed') {
                            text = 'Hoàn thành';
                        }

                        statusReservation.html(text);
                        alert('Hủy đơn đặt bàn thất bại, đơn đặt bàn của bạn không thể hủy bỏ');
                    }
                });
            }
        }

        function toggleModalEvaluate(id) {
            const modalEvaluate = document.getElementById(`modalEvaluate-${id}`);
            const modal = document.getElementById(`modal-${id}`);
            const body = document.body;

            if (modalEvaluate.classList.contains('hidden')) {
                modal.classList.add('hidden'); // Hide the main modal
                modalEvaluate.classList.remove('hidden'); // Show the evaluate modal
                body.classList.add('modal-open');
            } else {
                modalEvaluate.classList.add('hidden'); // Hide the evaluate modal
                body.classList.remove('modal-open');
            }
        }

        function pay() {

        }

        // Close the modal by clicking on the overlay
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('.modal-overlay');
            modals.forEach(modal => {
                // Only close modal if clicked outside the modal content (inside overlay)
                if (!modal.contains(event.target) && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('modal-open');
                }
            });
        });

        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                const body = document.body;
                // Validate the form
                var rating = $("input[name='rating']:checked").val();
                var comment = $('#comment').val();
                var invoice_id = $('input[name="invoice_id"]').val(); // Get the hidden invoice ID
                var id = $('input[name="id"]').val(); // Get the hidden invoice ID
                const modalEvaluate = document.getElementById(`modalEvaluate-${id}`);
                if (!rating || !comment) {
                    $('#error-msg').text('Vui lòng chọn điểm đánh giá và nhập đánh giá của bạn');
                    return false;
                }

                // Prepare data to be sent
                var formData = {
                    '_token': $('input[name="_token"]').val(),
                    'rating': rating,
                    'comment': comment,
                    'invoice_id': invoice_id // Include the hidden invoice ID in the form data
                };

                // Perform the AJAX request
                $.ajax({
                    url: '{{ route('review.post') }}', // Replace with your route name
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the response from the server
                        if (response.success) {
                            $('#simple-msg').html(
                                '<div class="text-green-500">Đánh giá của bạn đã được gửi thành công!</div>'
                            );
                            $('#myForm')[0].reset();
                            alert('Cảm ơn bạn đã để lại đánh giá !!');
                            modalEvaluate.classList.add('hidden');
                            body.classList.remove('modal-open');
                        } else {
                            $('#simple-msg').html(
                                '<div class="text-red-500">Có lỗi xảy ra. Vui lòng thử lại sau.</div>'
                            );
                        }
                    },
                    error: function() {
                        $('#simple-msg').html(
                            '<div class="text-red-500">Có lỗi xảy ra. Vui lòng thử lại sau.</div>'
                        );
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('myForm').addEventListener('submit', function (e) {
            // Tìm nút submit
            var submitButton = document.getElementById('submitFormContact');
            
            // Tắt nút submit để không cho nhấn thêm
            submitButton.disabled = true;

            // Hiển thị thông báo loading (hoặc có thể sử dụng spinner)
            submitButton.value = "Đang xử lý...";  // Thay đổi nội dung nút thành "Đang xử lý..."
        });
    </script>
@endpush
