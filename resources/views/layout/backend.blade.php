<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr" data-startbar="light" data-bs-theme="{{ session('theme', 'light') }}">

<head>
    @include('backend.component.head')
</head>

<body>
    <div class="overlay"></div>
    <div class="spinner">
        <div></div>
    </div>

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
    <!-- Top Bar End -->ư

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
                    <h5 class="modal-title" id="messageModalLabel">Chi tiết đặt bàn</h5>
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