@extends('layout.backend')

@section('adminContent')
    {{-- @dd(Auth::user()->image) --}}
    <div class="container-xxl">
        <!-- Profile Image and Edit -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="d-flex align-items-center flex-row flex-wrap">
                                    <div class="position-relative me-3">
                                        <!-- Profile image preview -->
                                        <img id="profileImagePreview" src="{{ checkFile(Auth::user()->image) ?? '' }}"
                                            alt="Profile Image" height="120" width="120" class="rounded-circle">
                                        <a href="javascript:void(0);" id="changeImage"
                                            class="thumb-md d-flex align-items-center justify-content-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg">
                                            <i class="fas fa-camera"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold fs-22 mb-1">
                                            {{ Auth::user()->full_name ?? 'No data available' }}
                                        </h5>
                                        <p class="mb-0 text-muted fw-medium">
                                            {{ Auth::user()->email ?? 'No data available' }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Form to Update Profile Image -->
                                <form id="updateProfileImageForm" action="{{ route('profile.update.image') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*"
                                        style="display: none;">
                                    <button type="submit" id="uploadImageButton" class="btn btn-primary mt-2"
                                        style="display: none;">Cập nhật ảnh</button>
                                </form>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

        @include('backend.component.error')

        <!-- Personal Information Form -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Thông tin tài khoản</h4>
                            </div><!--end col-->
                            <div class="col-auto" id="div-edit">
                                <a href="javascript:void(0);" id="editButton"
                                    class="float-end text-muted d-inline-flex text-decoration-underline">
                                    <i class="iconoir-edit-pencil fs-18 me-1"></i>Chỉnh sửa
                                </a>
                            </div><!--end col-->
                            <div class="col-auto" id="div-cancel" style="display: none;">
                                <a href="javascript:void(0);" id="cancelButton"
                                    class="float-end text-muted d-inline-flex text-decoration-underline">
                                    <i class="fas fa-times fs-18 me-1"></i>Hủy
                                </a>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <!-- Display Information -->
                        <div id="infoDisplay">
                            <ul class="list-unstyled mb-0">
                                <li class="mt-2"><i class="las la-briefcase me-2 text-secondary fs-22 align-middle"></i>
                                    <b> Họ và tên </b> : {{ Auth::user()->full_name ?? 'No data available' }}
                                </li>
                                <li class="mt-2"><i class="las la-phone me-2 text-secondary fs-22 align-middle"></i>
                                    <b> Số điện thoại </b> : {{ Auth::user()->phone ?? 'No data available' }}
                                </li>
                                <li class="mt-2"><i class="las la-envelope text-secondary fs-22 align-middle me-2"></i>
                                    <b> Email </b> : {{ Auth::user()->email ?? 'No data available' }}
                                </li>
                                <li class="mt-2"><i class="las la-university me-2 text-secondary fs-22 align-middle"></i>
                                    <b> Quê quán </b> : {{ Auth::user()->address ?? 'No data available' }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Form -->
                        <form id="editForm" method="post" style="display: none;">
                            @csrf
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    value="{{ Auth::user()->full_name }}" required>
                                <div id="full_name_error" class="error-message text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    value="{{ Auth::user()->phone }}" required>
                                <div id="phone_error" class="error-message text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::user()->email }}" required>
                                <div id="email_error" class="error-message text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Quê quán</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{ Auth::user()->address }}" name="address">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!-- container -->
    @include('backend.ajax.updates_the_profile_image')
    <script>
        $(document).ready(function() {
            // Xử lý cập nhật thông tin người dùng
            // $('#editForm').on('submit', function (event) {
            //     event.preventDefault(); // Ngăn chặn form mặc định

            //     $.ajax({
            //         url: '{{ route('profile.update') }}', // Đường dẫn đến route
            //         method: 'POST',
            //         data: $(this).serialize(), // Lấy dữ liệu từ form
            //         success: function (response) {
            //             executeExample('success'); // Call success function
            //             $('.error-message').text(''); // Xóa các thông báo lỗi trước đó

            //             setTimeout(function () {
            //                 // Trigger the click event on the reload button
            //                 location.reload();
            //             }, 2500);
            //         },
            //         error: function (xhr) {
            //             if (xhr.status === 422) {
            //                 // Xử lý lỗi xác thực
            //                 const errors = xhr.responseJSON.error;
            //                 for (const key in errors) {
            //                     $('#' + key + '_error').html(errors[key]);
            //                 }
            //             }
            //         }
            //     });
            // });

            $('#editForm').on('submit', function(event) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định của form

                $.ajax({
                    url: '{{ route('profile.update') }}', // Đường dẫn đến route
                    method: 'POST',
                    data: $(this).serialize(), // Lấy dữ liệu từ form
                    success: function(response) {
                        executeExample('success'); // Hiển thị thông báo thành công
                        $('.error-message').text(''); // Xóa các thông báo lỗi trước đó

                        setTimeout(function() {
                            location.reload(); // Tải lại trang sau 2.5 giây
                        }, 2500);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Lấy thông tin lỗi từ response JSON
                            const errors = xhr.responseJSON.errors;
                            
                            for (const field in errors) {
                                // Hiển thị lỗi tương ứng bên dưới từng input
                                $('#' + field + '_error').text(errors[field][0]);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
