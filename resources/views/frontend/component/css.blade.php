<!-- favicon -->
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Css -->
<link href="{{ asset('frontend/assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/libs/swiper/css/swiper.min.css') }}" rel="stylesheet">
<!-- Main Css -->
<link href="{{ asset('frontend/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('frontend/assets/css/tailwind.min.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- resources/views/layouts/app.blade.php -->
<meta name="user-id" content="{{ Auth::id() }}">

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@vite('resources/js/checkUserSession.js')