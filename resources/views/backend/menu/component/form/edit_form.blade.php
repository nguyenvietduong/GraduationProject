<form id="myForm" class="p-4 pt-3" action="{{ route('admin.' . $object . '.update', $menuData->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">Tên món ăn <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name',  $menuData->name ?? "") }}" onkeyup="generateSlug('name', 'slug')" placeholder="">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-6 mb-2 mb-lg-1">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.slug') }}  <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug' ,$menuData->slug ?? "") }}" onkeyup="generateSlug('name', 'slug')" placeholder="">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-12 col-12 col-sm-12 mb-2 ">
                <label for="price" class="form-label">{{ __('messages.' . $object . '.fields.price_vi') }} <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price',$menuData->price?? "") }}" currency="VND" placeholder="">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="description"
                    class="form-label">Mô tả  <span class="text-danger">*</span></label>
                <textarea name="description" id="description" cols="30" rows=""
                    class="form-control
                 @error('description') is-invalid @enderror">{{ old('description',$menuData->description ?? "") }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name"
                    class="form-label">{{ __('messages.' . $object . '.fields.category_id') }} <span class="text-danger">*</span></label>
                <select name="category_id" id="category_id"
                    class="form-select form-select-lm  @error('category_id') is-invalid @enderror">
                    @foreach ($categories as $category) 
                        <option value="{{ $category->id }}" @selected($category->id == $menuData->category_id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.status') }} <span class="text-danger">*</span></label>
                <select name="status" id="status"
                    class="form-select form-select-lm  @error('status') is-invalid @enderror" id="status">
                    @php
                        $status = request('status') ?: old('status');
                        $statuses = __('messages.menu.status');
                    @endphp
                    @foreach ($statuses as $key => $option)
                        <option value="{{ $key }}" @selected($key == $menuData->status)>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 col-sm-12 mb-2 container">
                <div class="row">
                    <div class="col-lg-9 col-12 col-sm-12 mb-2 ">
                        <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.image_url') }} <span class="text-danger">*</span></label>
                        <input type="file" name="image_url" id="image_url"
                            class="form-control @error('image_url') is-invalid @enderror">
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-12 col-sm-12 mb-2 ">
                        <input type="hidden" value="{{$menuData->image_url}}" name="image_old">
                        <img id="" src="{{ asset('storage/'.$menuData->image_url) }}"
                        alt="Image Preview" style="max-width: 60px; margin-left: 10px;">
                    </div>
                </div>
            </div>

            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end form-group-->

    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">
            {{ __('messages.system.button.update') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}">
            <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>
</form>