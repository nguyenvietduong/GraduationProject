<form action="{{ route('admin.' . $object . '.update', $promotionData->id) }}" id="myForm" method="post">
    @csrf
    @method('put')
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
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="mb-2">{{ __('messages.' . $object . '.fields.name') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control mb-2" type="text" value="{{ $promotionData->title }}"
                                        name="title" readonly>
                                    <label
                                        class="mb-2">{{ __('messages.' . $object . '.fields.description') }}</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $promotionData->description }}</textarea>
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
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.code') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control mb-2 uppercase @error('code') is-invalid @enderror"
                                    type="text" name="code" value="{{ $promotionData->code }}" readonly>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-select selectPromotion" id="" disabled>
                                    @foreach (__('messages.promotion.type') as $key => $value)
                                        <option value="{{ $key }}" b:>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="type" value="{{ $promotionData->type }}">
                        </div>
                        <div class="col-lg-6">
                            <label class="mb-2">{{ __('messages.' . $object . '.fields.total') }} <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <input id="regexp-mask" type="text" value="{{ $promotionData->total }}"
                                    class="form-control" name="total" readonly>
                                <span class="input-group-text"
                                    id="basic-addon2">{{ __('messages.promotion.system.times') }} </span>
                            </div>
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.discount') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" value="{{ $promotionData->discount }}"
                                        class="form-control int" name="discount" readonly>
                                    @foreach (__('messages.promotion.type') as $key => $value)
                                        @if ($promotionData->type == $key)
                                            <span class="input-group-text typePromotion"
                                                id="basic-addon2">{{ $value }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.startDate') }} <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local" value="{{ $promotionData->start_date }}"
                                    class="form-control" name="start_date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.isActive') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="" disabled>
                                    @foreach (__('messages.promotion.status') as $key => $value)
                                        <option value="{{ $key }}" @selected($promotionData->is_active == $key)>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="is_active" value="{{ $promotionData->is_active }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label class="mb-2">{{ __('messages.' . $object . '.fields.minOrder') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <input id="regexp-mask" type="text" name="min_order_value"
                                            value="{{ $promotionData->min_order_value }}" class="form-control int"
                                            readonly>
                                        <span class="input-group-text" id="basic-addon2">đ</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label class="mb-2">{{ __('messages.' . $object . '.fields.maxDiscount') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control int"
                                            value="{{ $promotionData->max_discount }}" name="max_discount" readonly>
                                        <span class="input-group-text" id="basic-addon2">đ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.endDate') }} <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local"
                                    class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                    value="{{ $promotionData->end_date ?? null }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-primary me-2"
                onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.update') }}</button>
            <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                    class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
        </div>

    </div>
</form>
