<form action="{{ route(__('messages.' . $object . '.store.route')) }}" id="myForm" method="post">
    @csrf
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
                                    <input class="form-control mb-2 @error('title') is-invalid @enderror" type="text"
                                        name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <label
                                        class="mb-2">{{ __('messages.' . $object . '.fields.description') }}</label>
                                    <textarea name="description" class="form-control" id="" cols="20" rows="10">{{ old('description') }}</textarea>
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
                            <h4 class="card-title">{{ __('messages.promotion.system.cardBot') }}</h4>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="row">
                        {{-- <div class="col-lg-12"> --}}
                        <div class="col-lg-6">
                            <label class="mb-2">{{ __('messages.' . $object . '.fields.code') }} <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <input
                                    class="form-control inputCodePromotion uppercase @error('code') is-invalid @enderror"
                                    type="text" name="code" value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button class="btn btn-secondary randomCodePromotion" type="button"
                                    id="button-addon2">{{ __('messages.promotion.system.random') }}</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.type') }} <span
                                        class="text-danger">*</span></label>
                                <select name="type" class="form-select selectPromotion" id="">
                                    @foreach (__('messages.promotion.type') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- </div> --}}
                        <div class="col-lg-6">
                            <label class="mb-2">{{ __('messages.' . $object . '.fields.total') }} <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <input type="text" name="total"
                                    class="form-control @error('total') is-invalid @enderror"
                                    value="{{ old('total') }}">
                                <span class="input-group-text"
                                    id="basic-addon2">{{ __('messages.promotion.system.times') }}</span>
                                @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-6"> --}}
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.discount') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group mb-2">
                                    <input type="number" name="discount"
                                        class="form-control inputDiscount @error('discount') is-invalid @enderror"
                                        value="{{ old('discount') }}">
                                    <span class="input-group-text typePromotion" id="basic-addon2">%</span>
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- </div> --}}
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.startDate') }} <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local" name="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.isActive') }} <span
                                        class="text-danger">*</span></label>
                                <select name="is_active" class="form-select" id="">
                                    @foreach (__('messages.promotion.status') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label class="mb-2">{{ __('messages.' . $object . '.fields.minOrder') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <input type="number" name="min_order_value"
                                            class="form-control @error('min_order_value') is-invalid @enderror"
                                            value="{{ old('min_order_value') }}">
                                        <span class="input-group-text" id="basic-addon2">đ</span>
                                        @error('min_order_value')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label class="mb-2">{{ __('messages.' . $object . '.fields.maxDiscount') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <input type="number"
                                            class="form-control @error('max_discount') is-invalid @enderror"
                                            name="max_discount" value="{{ old('max_discount') }}">
                                        <span class="input-group-text" id="basic-addon2">đ</span>
                                        @error('max_discount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="mb-2">{{ __('messages.' . $object . '.fields.endDate') }} <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local"
                                    class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                    value="{{ old('end_date') }}">
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
                onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.create') }}</button>
            <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                    class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
        </div>

    </div>
</form>
