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
            display: none; /* Ẩn mặc định */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
            z-index: 999; /* Nằm trên các nội dung khác */
            backdrop-filter: blur(10px); /* Làm mờ nội dung phía sau */
        }
    
        /* Spinner trung tâm */
        .spinner {
            display: none; /* Ẩn mặc định */
            position: fixed;
            top: 50%; /* Giữa màn hình */
            left: 50%;
            transform: translate(-50%, -50%); /* Căn giữa */
            z-index: 1000; /* Nằm trên cả overlay */
            width: 60px;
            height: 60px;
            border: 5px solid #ddd; /* Viền ngoài */
            border-top: 5px solid #3498db; /* Viền xoay */
            border-radius: 50%;
            animation: spin 1s linear infinite; /* Hiệu ứng xoay */
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
            filter: blur(5px); /* Làm mờ toàn bộ nội dung */
            pointer-events: none; /* Vô hiệu hóa tương tác */
        }
    
        /* Làm mờ startbar khi spinner hiển thị */
        .startbar.blur {
            filter: blur(5px); /* Làm mờ startbar */
            pointer-events: none; /* Vô hiệu hóa tương tác */
        }
    
        /* Làm mờ topbar khi spinner hiển thị */
        .topbar.blur {
            filter: blur(5px); /* Làm mờ topbar */
            pointer-events: none; /* Vô hiệu hóa tương tác */
        }
    </style>    

    <div class="card-body pt-0">
        <div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts"
            style="">
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
    <div class="modal fade" id="messageModalNotification" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
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

    @include('backend.component.Javascript')
</body>
<!--end body-->
</html>