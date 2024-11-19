<div class="modal fade bd-example-modal-xl-{{ $data->id }}" id="bd-example-modal-xl-{{ $data->id }}" tabindex="-1"
    role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myExtraLargeModalLabel">{{ __('messages.promotion.system.cardBot') }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <div class="row">
                    @php
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
                    <h4 class="m-3">{{ __('messages.invoice.fields.invoice_detail') }}</h4>
                    @if (isset($invoiceDetail) && is_object($invoiceDetail) && $invoiceDetail->isNotEmpty())
                        @foreach ($invoiceDetail as $key => $data)
                            @php
                                $total_amount += $data->total;
                            @endphp
                            <div class="col-md-3 mb-2">
                                <div class="card">
                                    <div class="card-body border">
                                        <h5 class="mb-0">
                                            {{ $data->menu->name ?? 'Không có dữ liệu' }}
                                        </h5>
                                        <p class="mb-0">Giá tiền:
                                            {{ number_format($data->price ?? 0, 0, ',', '.') }} đ (SL: {{ $data->quantity ?? 0 }}) </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <h5 class="mx-3">Tổng hóa đơn: {{ number_format($total_amount ?? 0, 0, ',', '.') }} đ
                        </h5>
                    @else
                        <p class="text-center">Không có dữ liệu</p>
                    @endif
                </div>
                <hr>
                <h4 class="m-3 ">{{ __('messages.reservation_details.fields.reservation_detail') }} - Số
                        khách: {{ $guest ?? 'Không có dữ liệu' }}</h4>
                <div class="row">
                    @if (isset($reservationDetail) && is_object($reservationDetail) && $reservationDetail->isNotEmpty())
                        @foreach ($reservationDetail as $key => $data)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body border">
                                        <h5 class="mb-0">
                                            Bàn: {{ $data->table->name ?? 'Không có dữ liệu' }} - Tối đa:
                                            {{ $data->table->capacity ?? 'Không có dữ liệu' }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>{{ __('messages.system.no_data_available') }}</p>
                        </div>
                    @endif
                </div>
                @php
                    if (isset($promotion)) {
                        if ($promotion->type == 'fixed') {
                            $voucher_discount = $promotion->discount;
                        } else {
                            if (($total_amount * $promotion->discount) / 100 > $promotion->max_discount) {
                                $voucher_discount = $promotion->max_discount;
                            } else {
                                $voucher_discount = (total_amount * $promotion->discount) / 100;
                            }
                        }
                    }
                @endphp
                <hr>
                <h4 class="m-3 ">{{ __('messages.promotion.fields.isUsed') }}</h4>
                <div class="row">
                    @if (isset($promotionDetail) && is_object($promotionDetail))
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class=" border">
                                    <h5 class="card-title mb-0">
                                        Mã giảm giá: {{ $promotionDetail->promotion->code ?? 'Không có dữ liệu' }}
                                    </h5>
                                    <p class="mb-0">Tên mã :
                                        {{ $promotionDetail->promotion->title ?? 'Không có dữ liệu' }}</p>
                                    <p class="mb-0">Mô tả :
                                        {{ $promotionDetail->promotion->description ?? 'Không có dữ liệu' }}</p>
                                    <p class="mb-0">Giảm giá :
                                        {{ number_format($voucher_discount ?? 0, 0, ',', '.') }} đ</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <p class="m-3">{{ __('messages.system.no_data_available') }}</p>
                        </div>
                    @endif
                </div>
                <hr>
                <h4 class="m-3">Tổng tiền: {{ number_format($total_amount - $voucher_discount ?? 0, 0, ',', '.') }}
                    đ</h4>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
