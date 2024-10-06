<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.account.' . $object . '.store.route')) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <div class="col-lg-12 align-self-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <label for="profile_picture" class="form-label">{{ __('messages.account.fields.profile_picture') }}</label>
                            <div class="card-body pt-0">
                                <div class="d-grid">
                                    <div class="row mb15">
                                        <div class="col-lg-6 col-6">
                                            <div class="form-row">
                                                <input type="file" id="imageInput" name="image" accept="image/*" hidden />
                                                <label class="btn-upload btn btn-primary mt-3" for="imageInput">{{ __('messages.system.button.upload') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-6">
                                            <img id="imagePreview" src="{{ session('image_temp') ? Storage::url(session('image_temp')) : '' }}" alt="Image Preview" style="display: {{ session('image_temp') ? 'block' : 'none' }}; max-width: 100px; margin-left: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12 mb-2 mb-lg-1">
                <label for="username" class="form-label">{{ __('messages.account.fields.name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name" value="{{ old('name') }}" placeholder="{{ __('messages.account.fields.name_placeholder') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="email">{{ __('messages.account.fields.email') }}</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="{{ __('messages.account.fields.email_placeholder') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="phone">{{ __('messages.account.fields.phone') }}</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" id="phone" placeholder="{{ __('messages.account.fields.phone_placeholder') }}">
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="address">{{ __('messages.account.fields.address') }}</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" id="address" placeholder="{{ __('messages.account.fields.address_placeholder') }}">
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="password">{{ __('messages.account.fields.password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('messages.account.fields.password_placeholder') }}">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="re_password">{{ __('messages.account.fields.re_password') }}</label>
                <input type="password" class="form-control @error('re_password') is-invalid @enderror" name="re_password" id="re_password" placeholder="{{ __('messages.account.fields.re_password_placeholder') }}">
                @error('re_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">{{ __('messages.account.fields.role') }}</label>
                <select class="form-select @error('role') is-invalid @enderror" name="role">
                    @foreach(__('messages.account.role') as $key => $value)
                    <option value="{{ $key }}" {{ set_selected('role', $key) }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.account.' . $object . '.index.route')) }}">
            <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button>
        </a>
    </div>
</form>
