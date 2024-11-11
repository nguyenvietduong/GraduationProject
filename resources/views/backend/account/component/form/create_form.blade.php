<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.account.' . $object . '.store.route')) }}"
    method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <div class="col-lg-12 align-self-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <label for="profile_picture"
                                class="form-label">{{ __('messages.account.fields.profile_picture') }}</label>
                            <div class="card-body pt-0">
                                <div class="row mb15">
                                    <!-- Nút tải lên -->
                                    <div class="col-lg-6 col-6">
                                        <div class="form-row">
                                            <input type="file" id="imageInput" name="image" accept="image/*" hidden />
                                            <label class="btn-upload btn btn-primary mt-3"
                                                for="imageInput">{{ __('messages.system.button.upload') }}</label>

                                            <!-- Nút xóa ảnh -->
                                            <button id="removeImageBtn" type="button" class="btn btn-danger mt-3"
                                                style="display: none;">Xóa</button>
                                        </div>
                                    </div>

                                    <!-- Ảnh xem trước và nút xóa -->
                                    <div class="col-lg-6 col-6">
                                        <img id="imagePreview"
                                            src="{{ session('image_temp') ? checkFile(session('image_temp')) : '' }}"
                                            style="display: {{ session('image_temp') ? 'block' : 'none' }}; max-width: 100px; margin-left: 10px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12 mb-2 mb-lg-1">
                <label for="full_name" class="form-label">{{ __('messages.account.fields.full_name') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                    name="full_name" value="{{ old('full_name') }}"
                    placeholder="{{ __('messages.account.fields.name_placeholder') }}">
                @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="email">{{ __('messages.account.fields.email') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" id="email"
                    placeholder="{{ __('messages.account.fields.email_placeholder') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="phone">{{ __('messages.account.fields.phone') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" id="phone"
                    placeholder="{{ __('messages.account.fields.phone_placeholder') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="password">{{ __('messages.account.fields.password') }} <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="password" placeholder="{{ __('messages.account.fields.password_placeholder') }}">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="re_password">{{ __('messages.account.fields.re_password') }} <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('re_password') is-invalid @enderror"
                    name="re_password" id="re_password"
                    placeholder="{{ __('messages.account.fields.re_password_placeholder') }}">
                @error('re_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">{{ __('messages.system.status') }} <span class="text-danger">*</span></label>
                <select class="form-select form-select-lm @error('status') is-invalid @enderror" name="status"
                    id="status">
                    @foreach(__('messages.account.status') as $key => $value)
                        <option value="{{ $key }}" @selected($key == old('status'))>{{ $value }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">{{ __('messages.account.fields.role') }} <span class="text-danger">*</span></label>
                <select class="form-select form-select-lm @error('role_id') is-invalid @enderror" name="role_id"
                    id="role_id">
                    @foreach($dataRole as $key => $value)
                        <option value="{{ $key }}" @selected($key == old('role_id'))>{{ $value }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-12 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="address">{{ __('messages.account.fields.address') }}</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                    value="{{ old('address') }}" id="address"
                    placeholder="{{ __('messages.account.fields.address_placeholder') }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">{{
    __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.account.' . $object . '.index.route')) }}">
            <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button>
        </a>
    </div>
</form>