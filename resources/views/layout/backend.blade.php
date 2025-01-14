<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr" data-startbar="light" data-bs-theme="{{ session('theme', 'light') }}">

<head>
    @include('backend.component.head')
</head>

<body>
    <div class="overlay"></div>
    <div class="spinner"></div>

    <style>
        /* Overlay che toàn màn hình */
        .overlay {
            display: none;
            /* Ẩn mặc định */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Màu nền mờ */
            z-index: 999;
            /* Nằm trên các nội dung khác */
            backdrop-filter: blur(10px);
            /* Làm mờ nội dung phía sau */
        }

        /* Spinner trung tâm */
        .spinner {
            display: none;
            /* Ẩn mặc định */
            position: fixed;
            top: 50%;
            /* Giữa màn hình */
            left: 50%;
            transform: translate(-50%, -50%);
            /* Căn giữa */
            z-index: 1000;
            /* Nằm trên cả overlay */
            width: 60px;
            height: 60px;
            border: 5px solid #ddd;
            /* Viền ngoài */
            border-top: 5px solid #3498db;
            /* Viền xoay */
            border-radius: 50%;
            animation: spin 1s linear infinite;
            /* Hiệu ứng xoay */
        }

        /* Hiệu ứng xoay cho spinner */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Làm mờ body */
        body.blur {
            filter: blur(5px);
            /* Làm mờ toàn bộ nội dung */
            pointer-events: none;
            /* Vô hiệu hóa tương tác */
        }

        /* Làm mờ startbar khi spinner hiển thị */
        .startbar.blur {
            filter: blur(5px);
            /* Làm mờ startbar */
            pointer-events: none;
            /* Vô hiệu hóa tương tác */
        }

        /* Làm mờ topbar khi spinner hiển thị */
        .topbar.blur {
            filter: blur(5px);
            /* Làm mờ topbar */
            pointer-events: none;
            /* Vô hiệu hóa tương tác */
        }
    </style>

    <div class="card-body pt-0">
        <div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts" style="">
            <div class="toast-container position-absolute p-3" id="toastPlacement" style="top: 0; right: 0;">
                <!-- Toasts sẽ được thêm tự động ở đây -->
            </div>
        </div>
    </div>

    <!-- Top Bar Start -->
    @include('backend.component.top_bar')
    <!-- Top Bar End -->

    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="{{ route('admin.dashboard.index') }}" class="logo">
                @include('backend.component.logo')
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        @include('backend.component.startbar_menu')
        <!--end startbar-menu-->
    </div>
    <!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->

    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content">

            @yield('adminContent')

            <!--Start Footer-->
            @include('backend.component.footer')
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Modal for Notification -->
    <div class="modal fade" id="messageModalNotification" tabindex="-1" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalName"></p>
                    <p id="modalPhone"></p>
                    <p id="modalEmail"></p>
                    <p id="modalGuest"></p>
                    <p id="modalReservationTime"></p>
                    <p id="modalSpecialRequest"></p>
                </div>
                <div class="modal-footer">
                    <a id="reservation-detail" href="" type="button" class="btn btn-success">Chi tiết</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role_id != 3)
        <div class="modal fade bd-example-modal-lg" id="create-reservation" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myLargeModalLabel">Tạo đơn mới</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div><!--end modal-header-->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="mb-2">Họ tên</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="nameAddNew" class="form-control">
                                </div>
                                <p class="errorReservation errNameReservation text-danger"></p>

                                <label class="mb-2">Email</label>
                                <div class="input-group mb-2">
                                    <input type="email" name="emailAddNew" class="form-control">
                                </div>
                                <p class="errorReservation errEmailReservation text-danger"></p>

                            </div>
                            <div class="col-lg-6">
                                <label class="mb-2">Điện thoại</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="phoneAddNew" class="form-control">
                                </div>
                                <p class="errorReservation errPhoneReservation text-danger"></p>

                                <label class="mb-2">Số người</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="guestAddNew" class="form-control">
                                </div>
                                <p class="errorReservation errGuestReservation text-danger"></p>

                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" for="message">Ghi chú</label>
                                <textarea class="form-control" name="messageAddNew" rows="5" id="message"></textarea>
                            </div>
                        </div><!--end row-->
                    </div><!--end modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary btnCreateReservation">Tạo đơn</button>
                    </div><!--end modal-footer-->
                </div><!--end modal-content-->
            </div><!--end modal-dialog-->
        </div>

        <button class="chat-button btn btn-primary" type="button" data-bs-toggle="modal"
            data-bs-target="#create-reservation">
            <div class="icon-wrapper">
                <i class="fas fa-book"></i> <!-- Icon -->
                <span class="chat-text">Tạo đơn mới</span>
            </div>
        </button>
    @endif

    <style>
        /* Chat Button Styles */
        .chat-button {
            position: fixed;
            bottom: 50px;
            right: 20px;
            /* Đặt vị trí bên phải màn hình */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.5s ease;
            transform-origin: right center;
            /* Thiết lập trục mở rộng từ phải */
        }

        .chat-button .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: opacity 0.5s ease;
            flex-direction: row-reverse;
            /* Đảo hướng icon và text */
        }

        .chat-button .chat-text {
            display: none;
            margin-right: 10px;
            /* Cách biểu tượng 10px */
            font-size: 14px;
            white-space: nowrap;
        }

        .chat-button.expanded {
            width: 170px;
            border-radius: 30px;
            right: 20px;
            /* Giữ nút mở rộng từ vị trí cố định */
        }

        .chat-button.expanded .chat-text {
            display: inline;
        }

        .chat-button.expanded .fas {
            margin-left: 5px;
            /* Đặt biểu tượng sát hơn khi mở rộng */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const chatButton = document.querySelector('.chat-button');

            // Hàm để bật ra
            const expandButton = () => {
                chatButton.classList.add('expanded');
                setTimeout(collapseButton, 3000); // Sau 3 giây bật vào
            };

            // Hàm để bật vào
            const collapseButton = () => {
                chatButton.classList.remove('expanded');
                setTimeout(expandButton, 3000); // Sau 3 giây bật ra lại
            };

            // Khởi chạy hiệu ứng
            setTimeout(expandButton, 3000); // Sau 3 giây bắt đầu bật ra
        });
    </script>

    @include('backend.component.Javascript')
</body>
<!--end body-->

</html>
