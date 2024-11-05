<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.' . $object . '.store.route')) }}" method="post"
    enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name_vi" class="form-label">{{ __('messages.' . $object . '.fields.name_vi') }}</label>
                <input type="text" class="form-control @error('name.vi') is-invalid @enderror" id="name_vi"
                    name="name[vi]" value="{{ old('name.vi') }}" placeholder="">
                @error('name.vi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name_en" class="form-label">{{ __('messages.' . $object . '.fields.name_en') }}</label>
                <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en"
                    name="name[en]" value="{{ old('name.en') }}" placeholder=""
                    onkeyup="generateSlug('name_en', 'slug')">
                @error('name.en')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-12 col-12 col-sm-12 mb-2 ">
                <label for="price" class="form-label">{{ __('messages.' . $object . '.fields.price_vi') }}</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price') }}" currency="VND" placeholder="" min="0">
                @error('price.vi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="description_vi"
                    class="form-label">{{ __('messages.' . $object . '.fields.description_vi') }} </label>
                <textarea name="description[vi]" id="description_vi" cols="30" rows=""
                    class="form-control
                 @error('description[vi]') is-invalid @enderror">{{ old('description.vi') }}</textarea>
                @error('description[vi]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="description_en"
                    class="form-label">{{ __('messages.' . $object . '.fields.description_en') }}</label>
                <textarea name="description[en]" id="description_en" cols="30" rows="2"
                    class="form-control
                 @error('description[en]') is-invalid @enderror">{{ old('description.en') }}</textarea>
                @error('description[en]')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name"
                    class="form-label">{{ __('messages.' . $object . '.fields.category_id') }}</label>
                <select name="category_id" id="category_id"
                    class="form-select form-select-lm  @error('category_id') is-invalid @enderror">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ renderDataByLang($category->name) }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.status') }}</label>
                <select name="status" id="status"
                    class="form-select form-select-lm  @error('status') is-invalid @enderror" id="status">
                    @php
                    $status = request('status') ?: old('status');
                    $statuses = __('messages.menu.status');
                    @endphp
                    @foreach ($statuses as $key => $option)
                    <option value="{{ $key }}">
                        {{ $option }}
                    </option>
                    @endforeach
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-6 mb-2 mb-lg-1">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.slug') }} </label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug') }}" placeholder="">
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.image_url') }}</label>
                <input type="file" name="image_url" id="image_url"
                    class="form-control @error('image_url') is-invalid @enderror">
                @error('image_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end form-group-->
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2"
            onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>
</form>