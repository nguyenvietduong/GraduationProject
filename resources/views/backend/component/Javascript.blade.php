<!-- Encode translations -->
<script>
    const translations = @json(trans('messages.system', [], app()->getLocale()));

    // Detect the user's preferred language
    const language = '{{ App::getLocale() }}';

    $(document).ready(function() {
        // Check for session flash messages
        @if (session('success'))
            executeExample('success');
        @elseif (session('error'))
            executeExample('error');
        @endif
    });

    function executeExample(type) {
        if (type === 'success') {
            Swal.fire({
                icon: 'success',
                title: translations.successTitle, // Use your translation
                text: '{{ session('success') }}', // Flash message from session
            });
        } else if (type === 'error') {
            Swal.fire({
                icon: 'error',
                title: translations.errorTitle, // Use your translation
                text: '{{ session('error') }}', // Flash message from session
            });
        }
    }
    
    var csrfToken = '{{ csrf_token() }}';

    window.hasImageTemp = @json(session()->has('image_temp'));
</script>

<!-- Bootstrap v5 JS (after jQuery) -->
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional JS libraries -->
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/sweet-alert.init.js') }}"></script>
<script src="{{ asset('backend/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<script src="{{ asset('backend/assets/custom/js/set-language.js') }}"></script>
<script src="{{ asset('backend/assets/custom/js/set-theme.js') }}"></script>
<script src="{{ asset('backend/assets/custom/js/set-slug.js') }}"></script>
<script src="{{ asset('backend/assets/custom/js/convertPrice.js') }}"></script>
<!-- <script src="{{ asset('backend/assets/custom/js/set-select_all_checkbox.js') }}"></script> -->
<script src="{{ asset('backend/assets/libs/uppy/uppy.legacy.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/file-upload.init.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/form-wizard.js') }}"></script>
<script src="{{ asset('backend/assets/custom/js/ajax/set-notification.js') }}"></script>
<!-- <script src="{{ asset('backend/custom/customReservation.js') }}"></script> -->

@stack('script')
