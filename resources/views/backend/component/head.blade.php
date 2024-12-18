<!-- Meta Tags -->
<meta charset="utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Trang Quản Trị - Hương Việt</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Your Name or Company" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- include libraries(jQuer) -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Bootstrap v5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">

<!-- Additional Styles -->
<link rel="stylesheet" href="{{ asset('backend/assets/libs/jsvectormap/css/jsvectormap.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css" rel="stylesheet">
<link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/css/index.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('backend/assets/libs/uppy/uppy.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert -->
<link href="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('backend/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">

@if(Auth::check())
    <script>
        var userId = {{ auth()->id() }};
    </script>
@endif

@vite('resources/js/sendNotificationJob.js')
@vite('resources/js/reviewEvent.js')
@vite('resources/js/checkUserSession.js')
@stack('css')
