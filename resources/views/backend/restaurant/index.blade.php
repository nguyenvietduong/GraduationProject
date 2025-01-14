@extends('layout.backend')
@section('adminContent')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<div class="container-xxl">
    <div class="row justify-content-center">

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    <div class="container-xxl">
                        <!-- Restaurant Image and Edit -->
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                <div class="d-flex align-items-center flex-row flex-wrap">
                                                    <div class="position-relative me-3">
                                                        <!-- Restaurant image preview -->
                                                        <img id="restaurantImage"
                                                            src="{{ checkFile($restaurantDatas->image) ?? '' }}"
                                                            alt="Restaurant Image" height="120" width="120"
                                                            class="rounded-circle">
                                                        <a href="javascript:void(0);" id="changeImage"
                                                            class="thumb-md d-flex align-items-center justify-content-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg">
                                                            <i class="fas fa-camera"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-semibold fs-22 mb-1">
                                                            {{ $restaurantDatas->name ?? 'No data available' }}
                                                        </h5>
                                                        
                                                    </div>
                                                </div>
                                                <!-- Form to Update Restaurant Image -->
                                                <form id="updateRestaurantImageForm"
                                                    action="{{ route('restaurant.update.image') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" id="restaurantImageInput" name="restaurant_image"
                                                        accept="image/*" style="display: none;">
                                                    <button type="submit" id="uploadImageButton"
                                                        class="btn btn-primary mt-2" style="display: none;">Chỉnh sửa ảnh</button>
                                                </form>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        {{-- @include('backend.component.error') --}}

                        <!-- Personal Information Form -->
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="card-title">{{ __('messages.restaurant.fields.restaurant_information') }}</h4>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto" id="div-edit">
                                                <a href="javascript:void(0);" id="editButton"
                                                    class="float-end text-muted d-inline-flex text-decoration-underline">
                                                    <i class="iconoir-edit-pencil fs-18 me-1"></i>Chỉnh sửa
                                                </a>
                                            </div><!--end col-->
                                            <div class="col-auto" id="div-cancel" style="display: none;">
                                                <a href="javascript:void(0);" id="cancelButton"
                                                    class="float-end text-muted d-inline-flex text-decoration-underline">
                                                    <i class="fas fa-times fs-18 me-1"></i>Hủy bỏ
                                                </a>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-header-->
                                    <div class="card-body pt-0">
                                        <!-- Display Information -->
                                        <div id="infoDisplay">
                                            <ul class="list-unstyled mb-0">
                                                <li class="mt-2"><i
                                                        class="las fa-store-alt me-2 text-secondary fs-22 align-middle"></i>
                                                    <b> {{ __('messages.restaurant.fields.name') }} </b> : {{
                                                    $restaurantDatas->name ?? 'No data
                                                    available' }}
                                                </li>
                                                <li class="mt-2"><i
                                                        class="las la-phone me-2 text-secondary fs-22 align-middle"></i>
                                                    <b> {{ __('messages.restaurant.fields.phone') }} </b> : {{
                                                    $restaurantDatas->phone ?? 'No data available'
                                                    }}
                                                </li>
                                                <li class="mt-2"><i
                                                        class="las la-university text-secondary fs-22 align-middle me-2"></i>
                                                    <b> {{ __('messages.restaurant.fields.address') }} </b> : {{
                                                    $restaurantDatas->address ?? 'No data
                                                    available' }}
                                                </li>
                                                <li class="mt-2"><i
                                                        class="las fa-stopwatch me-2 text-secondary fs-22 align-middle"></i>
                                                    <b> {{ __('messages.restaurant.fields.opening_hours') }} </b> : {{
                                                    $restaurantDatas->opening_hours ?? 'No
                                                    data available'}}
                                                </li>
                                                <li class="mt-2"><i
                                                        class="las fa-stopwatch me-2 text-secondary fs-22 align-middle"></i>
                                                    <b> {{ __('messages.restaurant.fields.closing_time') }} </b> : {{
                                                    $restaurantDatas->closing_time ?? 'No
                                                    data available'}}
                                                </li>
                                                <li class="mt-2"><i
                                                        class="las far fa-star me-2 text-secondary fs-22 align-middle"></i>
                                                    <b> {{ __('messages.restaurant.fields.rating') }} </b> : {{
                                                    $restaurantDatas->rating ?? 'No data
                                                    available'}}
                                                </li>

                                                <li class="mt-2">
                                                    <i class="las iconoir-chat-bubble me-2 text-secondary fs-22 align-middle"></i>
                                                    <b>{{ __('messages.restaurant.fields.description') }}</b> : 
                                                    {{ $restaurantDatas->description ?? 'No data available' }}
                                                </li>
                                                
                                                
                                                

                                                <li class="mt-2">
                                                    <i class="las la-map me-2 text-secondary fs-22 align-middle"></i>
                                                    <b>{{ __('messages.restaurant.fields.google_map_link') }}</b>:
                                                    
                                                        <iframe src="{{ $restaurantDatas->google_map_link }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                    
                                                        <p>No map available</p>

                                                        
                                                    
                                                </li>
                                                






                                            </ul>
                                        </div> 

                                        <!-- Edit Form --> 
                                        <form id="editForm"
                                            action="{{ route('restaurant.update', $restaurantDatas->id ) }}"
                                            method="post" style="display: none;">
                                            @csrf
                                            <div class="mb-3  col-12 ">
                                                <label for="name" class="form-label">{{
                                                    __('messages.restaurant.fields.name') }} <span class="text-danger">*</span></label>
                                                <input type="text" onkeyup="generateSlug('name', 'slug')"
                                                    class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    value="{{ $restaurantDatas->name }}"
                                                    placeholder="{{ __('messages.restaurant.fields.name_placeholder') }}">
                                                    
                                                    <div id="name_error" class="error-message text-danger"></div>
                                                    
                                                
                                                
                                            </div>
                                            <div class="mb-3  col-12 ">
                                                <label for="slug" class="form-label">{{
                                                    __('messages.restaurant.fields.slug') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                                    value="{{ $restaurantDatas->slug }}">

                                                    <div id="slug_error" class="error-message text-danger"></div>
                                            </div>
                                            <div class="mb-3  col-12">
                                                <label for="phone" class="form-label">{{
                                                    __('messages.restaurant.fields.phone') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                                    value="{{ $restaurantDatas->phone }}"
                                                    placeholder="{{ __('messages.restaurant.fields.phone_placeholer') }}">
                                                <div id="phone_error" class="error-message text-danger"></div>
                                            </div>
                                            <div class="mb-3  col-12">
                                                <label for="address" class="form-label">{{
                                                    __('messages.restaurant.fields.address') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                    value="{{ $restaurantDatas->address }}"
                                                    placeholder="{{ __('messages.restaurant.fields.address_placeholer') }}">
                                                    <div id="address_error" class="error-message text-danger"></div>
                                            </div>
                                            <div class="mb-3  col-12">
                                                <label for="opening_hours" class="form-label">{{
                                                    __('messages.restaurant.fields.opening_hours') }} <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control @error('opening_hours') is-invalid @enderror" id="opening_hours"
                                                    name="opening_hours" value="{{ $restaurantDatas->opening_hours }}"
                                                    placeholder="{{ __('messages.restaurant.fields.opening_hours_placeholder') }}">
                                                    <div id="opening_hours_error" class="error-message text-danger"></div>
                                            </div>
                                            <div class="mb-3  col-12">
                                                <label for="closing_time" class="form-label">{{
                                                    __('messages.restaurant.fields.closing_time') }} <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control @error('closing_time') is-invalid @enderror" id="closing_time"
                                                    name="closing_time" value="{{ $restaurantDatas->closing_time }}"
                                                    placeholder="{{ __('messages.restaurant.fields.closing_time_placeholder') }}">
                                                    <div id="closing_time_error" class="error-message text-danger"></div>
                                            </div>
                                            <div class="mb-3  col-12">
                                                <label for="google_map_link" class="form-label">{{
                                                    __('messages.restaurant.fields.google_map_link') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('google_map_link') is-invalid @enderror" id="google_map_link"
                                                    name="google_map_link"
                                                    value="{{ $restaurantDatas->google_map_link }}"
                                                    placeholder="{{ __('messages.restaurant.fields.google_map_link_placeholer') }}">
                                                    <div id="google_map_link_error" class="error-message text-danger"></div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="description" class="form-label">{{ __('messages.restaurant.fields.description') }} <span lass="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" 
                                                value="{{ ($restaurantDatas->description) }}" required>
                                                <div id="description_error" class="error-message text-danger">@error('description.vi') {{ $message }} @enderror</div>
                                            </div>

                                            {{-- <button type="submit" class="btn btn-primary">Update Restaurant</button> --}}

                                            <button type="submit" onclick="executeExample( 'editForm')"
                                                class="btn btn-primary">{{ __('messages.system.button.update') }}</button>
                                                
                                        </form>
                                        

                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div><!-- container -->
                    @include('backend.ajax.updates_the_restaurant_image')

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Xử lý cập nhật thông tin người dùng
        $('#editForm').on('submit', function (event) {
            event.preventDefault(); // Ngăn chặn form mặc định

            $.ajax({
                url: '{{ route("restaurant.update", $restaurantDatas->id) }}', // Đường dẫn đến route
                method: 'POST',
                data: $(this).serialize(), // Lấy dữ liệu từ form
                success: function (response) {
                    executeExample('success'); // Call success function
                    $('.error-message').text(''); // Xóa các thông báo lỗi trước đó

                    setTimeout(function () {
                        // Trigger the click event on the reload button
                        location.reload();
                    }, 2500);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        // Xử lý lỗi xác thực
                        const errors = xhr.responseJSON.error;
                        for (const key in errors) {
                            $('#' + key + '_error').html(errors[key]);
                        }
                    }
                }
            });
        });
    });
</script>

<script src="{{ asset('backend/assets/custom/js/set-slug.js') }}">
    getElementById(name)
</script>

@endsection