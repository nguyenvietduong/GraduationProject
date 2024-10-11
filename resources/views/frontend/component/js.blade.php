<script src="{{ asset('frontend/assets/libs/shufflejs/shuffle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/tobii/js/tobii.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/swiper/js/swiper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins.init.js') }}"></script>
<script src="{{ asset('frontend/assets/js/app.js') }}"></script>

@stack('scripts')

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: "{{ __('messages.system.alert.error.title') }}",  // Chuyển đổi chuỗi dịch qua Blade
            text: "{{ session('error') }}",
        });
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ __('messages.system.alert.titleSuccess') }}",  // Chuyển đổi chuỗi dịch qua Blade
            text: "{{ session('success') }}",
        });
    </script>
@endif
