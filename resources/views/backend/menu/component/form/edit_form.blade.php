<form id="myForm" class="p-4 pt-3" action="{{ route('admin.' . $object . '.update', $menuData->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $menuData->name ?? "") }}" placeholder="" onkeyup="generateSlug('name', 'slug')">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="slug" class="form-label">{{ __('messages.' . $object . '.fields.slug') }}</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug', $menuData->name ?? "") }}" placeholder="">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.price') }}</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price' ,(app()->getLocale() == 'en'?$menuData->price : $menuData->price*24000)) }}" placeholder="">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.category_id') }}</label>
                <select name="category_id" id="category_id"
                    class="form-select @error('category_id') is-invalid @enderror" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{$menuData->category_id == $category->id ? "selected" : ""}}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-12 col-sm-12 mb-2 container">
                <div class="row">

                    <div class="col-lg-9 col-12 col-sm-12 mb-2 ">
                        <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.image_url') }}</label>
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
            <div class="col-lg-6 col-12 col-sm-12">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.description') }}</label>
                <textarea name="description" id="" cols="30" rows="4" class="form-control @error('description') is-invalid @enderror" id="description">
                    {{ old('name' , $menuData->description , "") }}
                </textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
