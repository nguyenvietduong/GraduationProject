@extends('layout.admin')
@section('adminContent')
    @include('backend.component.error')

    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">

                            <div class="col-lg-12 border-end">
                                <h4 class="card-title fs-16 mb-0 pt-3 ps-4">{{ $config['seo']['edit']['title'] }} - {{ $cate->name ?? '' }}</h4>

                                <form id="myForm" class="p-4 pt-3" action="{{ route('admin.category.update', $cate->id) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                                                <label for="name" class="form-label">Category Name </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $cate->name ?? '') }}" onkeyup="generateSlug('name', 'slug')"
                                                    placeholder="Enter category name">
                                            </div><!--end col-->

                                            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                                                <label for="slug" class="form-label">Slug </label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    value="{{ old('slug', $cate->slug ?? '') }}" id="slug"
                                                    placeholder="Enter slug">
                                            </div><!--end col-->

                                            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                                                <label for="parent" class="form-label">Parent </label>
                                                <select name="parent_id" class="form-control setupSelect2" id="parent">
                                                    <option value="">No Parent</option>
                                                    @foreach ($categories as $category)
                                                        @include(
                                                            'backend.category.partials.category_option',
                                                            ['category' => $category]
                                                        )
                                                    @endforeach
                                                </select>
                                            </div><!--end col-->

                                        </div><!--end row-->
                                    </div><!--end form-group-->

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-primary me-2"
                                            onclick="confirmAndSubmit('myForm')">Update</button>


                                        <a href="{{ route('admin.category.index') }}"> <button type="button"
                                                class="btn btn-danger">Cancel</button></a>
                                    </div>

                                </form> <!--end form-->
                            </div>
                            <!--end col--><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
@endsection
<script src="/assets_back/js/image.js"></script>
