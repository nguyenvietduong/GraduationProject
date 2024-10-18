@extends('layout.backend')
@section('adminContent')
@push('css')
    <!-- Summernote Lite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <!-- Summernote Lite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <style>
        /* Giảm padding/margin cho màn hình nhỏ hơn */
        @media (max-width: 576px) {
            .card-header {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.2rem;
            }

            .container-xxl {
                padding-left: 10px;
                padding-right: 10px;
            }

            .card-body {
                padding: 10px;
            }

            /* Điều chỉnh Summernote cho thiết bị di động */
            .note-editor {
                font-size: 14px;
                /* Kích thước chữ nhỏ hơn */
            }
        }
    </style>
@endpush
<div class="container-xxl">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.button.update') }} {{ __('messages.' .
    $object . '.title') }} - {{ $data->title }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            <div class="col-lg-12 border-end">
                                @include('backend.' .
    $object . '.component.form.edit_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="/backend/assets/custom/js/show_image.js"></script>
        <script>
            $(document).ready(function () {
                $('#summernote').summernote({
                    height: 300, // Đặt chiều cao cho editor
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['picture', 'link', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Times New Roman'],
                    fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48'],
                    placeholder: 'Write here...',
                    callbacks: {
                        onImageUpload: function (files) {
                            // Gọi hàm upload hình ảnh
                            uploadImage(files[0]);
                        }
                    }
                });
            });

            // Hàm upload hình ảnh
            function uploadImage(file) {
                var data = new FormData();
                data.append("image", file);
                $.ajax({
                    url: "/blog/upload", // URL của route upload
                    type: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Lấy CSRF token từ meta tag
                    },
                    success: function (response) {
                        $('#summernote').summernote("insertImage", response.link); // Chèn hình ảnh vào Summernote
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Upload image failed:", textStatus, errorThrown);
                    }
                });
            }
        </script>
    @endpush
    @endsection