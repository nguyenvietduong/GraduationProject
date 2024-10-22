<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.' . $object . '.update.route'), $data->id) }}"
    method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <div class="row">
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <div class="col-lg-12 align-self-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <label for="profile_picture" class="form-label">Image Blog</label>
                            <div class="card-body pt-0">
                                <div class="d-grid">
                                    <div class="row mb15">
                                        <div class="col-lg-6 col-6">
                                            <div class="form-row">
                                                <input type="file" id="imageInput" name="image" accept="image/*"
                                                    hidden />
                                                <label class="btn-upload btn btn-primary mt-3"
                                                    for="imageInput">{{ __('messages.system.button.upload') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-6">
                                            <img id="imagePreview"
                                                src="{{ session('image->blog_temp') ? checkFile(session('image->blog_temp')) : checkFile($data->image) }}"
                                                style="display: {{ session('image->blog_temp') || checkFile($data->image) ? 'block' : 'none' }}; max-width: 100px; margin-left: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12 mb-2 mb-lg-1">
                <label for="title" class="form-label">Blog Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $data->title) }}" onkeyup="generateSlug('title', 'slug')">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    value="{{ old('slug', $data->slug) }}">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-12 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="content">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                    id="summernote">{!! old('content', $data->content) !!}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2"
            onclick="executeExample('handleDismiss', 'myForm')">{{
            __('messages.system.button.update') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}">
            <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button>
        </a>
    </div>
</form>