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
                <h4 class="m-3">{{ __('messages.invoice.fields.invoice_detail') }}</h4>
                <div class="row">
                    @php
                        $invoiceDetail = $data->invoice->invoiceItems;
                        $reservationDetail = $data->reservationDetails;
                    @endphp
                    @if (isset($invoiceDetail) && is_object($invoiceDetail) && $invoiceDetail->isNotEmpty())
                        @foreach ($invoiceDetail as $key => $data)
                            <div class="col-md-3 mb-2">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">
                                            {{ $data->menu->name ?? 'Không có dữ liệu' }}
                                            - {{ number_format($data->total ?? 0, 0, ',', '.') }}
                                        </h5>
                                    </div>
                                    <div class="card-body border">
                                        <p><strong>Số lượng:</strong> {{ $data->quantity ?? 0 }}</p>
                                        <p><strong>Giá tiền:</strong>
                                            {{ number_format($data->price ?? 0, 0, ',', '.') }} VND</p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">Không có dữ liệu</p>
                    @endif
                </div>
                <h4 class="m-3 ">{{ __('messages.reservation_details.fields.reservation_detail') }}</h4>
                <div class="row">
                    @if (isset($reservationDetail) && is_object($reservationDetail) && $reservationDetail->isNotEmpty())
                        @foreach ($reservationDetail as $key => $data)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">
                                            Bàn: {{ $data->table->name ?? 'Không có dữ liệu' }} - Số người: {{ $data->table->capacity ?? 'Không có dữ liệu' }}
                                        </h5>
                                    </div>
                                    <div class="card-body border">
                                        <p><strong>Số khách:</strong> {{ $data->guests_detail ?? 'Không có dữ liệu' }}</p>
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
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
