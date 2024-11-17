<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.' . $object . '.store.route')) }}" method="post">
    @csrf

    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.name') }} <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" onkeyup="generateSlug('name', 'slug')" placeholder="">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2 mb-lg-1">
                <label for="slug" class="form-label">{{ __('messages.' . $object . '.fields.slug') }} <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug') }}" onkeyup="generateSlug('name', 'slug')" placeholder="">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-12 mb-2 mb-lg-1">
                <label for="status" class="form-label mt-2">{{ __('messages.system.status') }} <span
                        class="text-danger">*</span></label>
                <select class="form-select form-select-lm @error('status') is-invalid @enderror" name="status"
                    id="status">
                    @foreach (__('messages.category.status') as $key => $value)
                        <option value="{{ $key }}" @selected($key == old('status'))>{{ $value }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- end col --}}
        </div>
        {{-- end row --}}
    </div>
    <!--end form-group-->
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2"
            onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>

</form>