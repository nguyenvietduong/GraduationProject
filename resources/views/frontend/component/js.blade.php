<script src="{{ asset('frontend/assets/libs/shufflejs/shuffle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/tobii/js/tobii.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/swiper/js/swiper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins.init.js') }}"></script>
<script src="{{ asset('frontend/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    flatpickr("#input-time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i", // Định dạng giờ: 14:00
        time_24hr: true, // Thiết lập theo giờ 24
    });
</script>


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

<script>
    var csrfToken = '{{ csrf_token() }}';
</script>