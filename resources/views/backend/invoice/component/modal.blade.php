@if (isset($data->invoice->invoiceItems))
    <div class="modal fade bd-example-modal-xl-{{ $data->id }}" id="bd-example-modal-xl-{{ $data->id }}"
        tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel">
                        {{ __('messages.promotion.system.cardBot') }}
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="row">
                        @php
                            $reservation = $data;
                            $invoice = $data->invoice;
                            $invoiceDetail = $data->invoice->invoiceItems;
                            $promotionDetail = $data->invoice->promotionDetail;
                            $reservationDetail = $data->reservationDetails;
                            $guest = $data->guests;
                            if (isset($promotionDetail)) {
                                $promotion = $promotionDetail->promotion;
                            }
                            $total_amount = 0;
                            $voucher_discount = 0;
                        @endphp
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Số
                                            khách: {{ $guest ?? 'Không có dữ liệu' }}</h4>

                                        @if (isset($reservationDetail) && is_object($reservationDetail) && $reservationDetail->isNotEmpty())
                                            <h4 class="card-title">
                                                Bàn sử dụng:
                                                {{ $reservationDetail->pluck('table_name')->implode(', ') }}
                                            </h4>
                                        @else
                                            <p class="text-center">Không có dữ liệu</p>
                                        @endif
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5 class="">{{ __('messages.invoice.fields.invoice_detail') }}</h5>

                                        @if (isset($invoiceDetail) && is_object($invoiceDetail) && $invoiceDetail->isNotEmpty())
                                            <table class="table " border="1">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên</th>
                                                        <th>Số lượng</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($invoiceDetail as $key => $data)
                                                        @php
                                                            $total_amount += $data->price * $data->quantity;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td> {{ $data->menu_name ?? 'Không có dữ liệu' }}</td>
                                                            <td> {{ $data->quantity ?? 0 }}</td>
                                                            <td>{{ number_format($data->price * $data->quantity ?? 0, 0, ',', '.') }}
                                                                đ</td>
                                                        </tr>
                                                    @endforeach
                                                    @php
                                                        if (isset($promotion)) {
                                                            if ($promotion->type == 'fixed') {
                                                                $voucher_discount = $promotion->discount;
                                                            } else {
                                                                if (
                                                                    ($total_amount * $promotion->discount) / 100 >
                                                                    $promotion->max_discount
                                                                ) {
                                                                    $voucher_discount = $promotion->max_discount;
                                                                } else {
                                                                    $voucher_discount =
                                                                        ($total_amount * $promotion->discount) / 100;
                                                                }
                                                            }
                                                            if (
                                                                $voucher_discount > $total_amount &&
                                                                $promotion->type == 'fixed'
                                                            ) {
                                                                $voucher_discount -= $total_amount;
                                                                $total_amount = 0;
                                                            }
                                                        }
                                                    @endphp
                                                    @if (isset($promotion))
                                                        <tr>
                                                            <td colspan="3">
                                                                Mã giảm giá: <span
                                                                    style="text-transform: uppercase;">{{ $promotionDetail->promotion->title ?? 'Không có dữ liệu' }}
                                                                    -
                                                                    {{ $promotionDetail->promotion->code ?? 'Không có dữ liệu' }}</span>
                                                            </td>
                                                            <td>
                                                                -
                                                                {{ number_format($voucher_discount ?? 0, 0, ',', '.') }}
                                                                đ
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="3">Tổng hóa đơn</td>
                                                        <td>{{ number_format($total_amount - $voucher_discount ?? 0, 0, ',', '.') }}
                                                            đ</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-center">Không có dữ liệu</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    @if ($invoice->isExport == false)
                        <button type="button" class="btn btn-warning" id="exportInvoice_{{ $reservation->id }}"
                            data-reservation-id="{{ $reservation->id }}">
                            In hóa đơn
                        </button>
                    @endif
                    <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Đóng</button>
                </div><!--end modal-footer-->
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div>
    <script>
        $(document).ready(function() {
            $('#exportInvoice_' + {{ $reservation->id }}).on('click', function() {
                const reservationId = $(this).data('reservation-id'); // Lấy ID từ data attribute
                const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Lấy CSRF token

                // Gửi AJAX request
                $.ajax({
                    url: '/admin/invoice/exportPDF', // Đường dẫn API
                    method: 'POST',
                    data: {
                        reservation_id: reservationId,
                        _token: csrfToken // CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            const pdfUrl = response.pdfUrl;

                            // Mở PDF trong một tab mới
                            window.open(pdfUrl, '_blank');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000)
                        } else {
                            alert('Lỗi khi tạo và lưu hóa đơn.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi khi gửi yêu cầu.');
                    }
                });
            });
        });
    </script>
@endif
