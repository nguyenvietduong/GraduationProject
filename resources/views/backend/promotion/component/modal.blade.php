<div class="modal fade bd-example-modal-xl-{{ $item->id }}" id="bd-example-modal-xl-{{ $item->id }}" tabindex="-1"
    role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myExtraLargeModalLabel">{{ __('messages.promotion.system.cardBot') }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">{{ __('messages.promotion.system.cardTop') }} </h4>
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>{{ __('messages.promotion.system.vn') }}</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label
                                                    class="mb-2">{{ __('messages.' . $object . '.fields.name') }}</label>
                                                <input class="form-control mb-2" type="text"
                                                    value="{{ $item->title }}" readonly>
                                                <label
                                                    class="mb-2">{{ __('messages.' . $object . '.fields.description') }}</label>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="10" readonly>{{ $item->description }}</textarea>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">{{ __('messages.promotion.system.cardBot') }} </h4>
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mb-2">{{ __('messages.' . $object . '.fields.code') }}</label>
                                        <input class="form-control mb-2" type="text" value="{{ $item->code }}"
                                            readonly>
                                    </div><!-- end col -->
                                    <div class="col-lg-6">
                                        <label class="mb-2">{{ __('messages.' . $object . '.fields.total') }}</label>
                                        <div class="input-group mb-2">
                                            <input id="regexp-mask" type="text" value="{{ $item->total }}"
                                                class="form-control" readonly>
                                            <span class="input-group-text"
                                                id="basic-addon2">{{ __('messages.promotion.system.times') }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="mb-2">{{ __('messages.' . $object . '.fields.discount') }}</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="discount"
                                                    class="form-control inputDiscount int"
                                                    value="{{ $item->discount }}" readonly>
                                                @foreach (__('messages.promotion.type') as $key => $value)
                                                    @if ($item->type == $key)
                                                        <span class="input-group-text typePromotion"
                                                            id="basic-addon2">{{ $value }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="mb-2">{{ __('messages.' . $object . '.fields.startDate') }}</label>
                                            <input type="text" value="{{ formatDate($item->start_date) }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label
                                                class="mb-2">{{ __('messages.' . $object . '.fields.isActive') }}</label>
                                            <select class="form-select modalPromotion_{{ $item->id }}"
                                                id="" disabled>
                                                @foreach (__('messages.promotion.status') as $key => $value)
                                                    <option value="{{ $key }}" @selected($item->is_active == $key)>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label
                                                    class="mb-2">{{ __('messages.' . $object . '.fields.minOrder') }}</label>
                                                <div class="input-group mb-2">
                                                    <input id="regexp-mask" type="text"
                                                        value="{{ $item->min_order_value }}"
                                                        class="form-control int" readonly>
                                                    <span class="input-group-text" id="basic-addon2">đ</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label
                                                    class="mb-2">{{ __('messages.' . $object . '.fields.maxDiscount') }}</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control int"
                                                        value="{{ $item->max_discount }}" readonly>
                                                    <span class="input-group-text" id="basic-addon2">đ</span>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $temp = formatDate($item->end_date);
                                            if ($temp == '') {
                                                $endDate = __('messages.promotion.system.noTime');
                                            } else {
                                                $endDate = $temp;
                                            }
                                        @endphp
                                        <div class="mb-2">
                                            <label
                                                class="mb-2">{{ __('messages.' . $object . '.fields.endDate') }}</label>
                                            <input type="text" class="form-control" value="{{ $endDate }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
