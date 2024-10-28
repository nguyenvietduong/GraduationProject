<!DOCTYPE html>
<html lang="en" class="{{ session('theme', 'light') }} scroll-smooth" dir="ltr">

<!-- Mirrored from shreethemes.in/veganfry/layouts/restaurant-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:06 GMT -->

<head>
    @include('frontend.component.meta')

    @include('frontend.component.css')
</head>

<body class="dark:bg-slate-900">
    <!-- Loader Start -->
    @include('frontend.component.loader')
    <!-- Loader End -->
    <!-- Start Navbar -->
    @include('frontend.component.navbar')

    @yield('contentUser')

    <!-- Footer Start -->
    @include('frontend.component.footer')
    <!-- Footer End -->

    <!-- Chat Popup -->
    @include('frontend.component.message')
    <!-- Chat Popup End -->

    <!-- Switcher -->
    @include('frontend.component.lightdark')

    <!-- Back to top -->
    @include('frontend.component.backtotop')
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    @include('frontend.component.js')
    <!-- JAVASCRIPTS -->
</body>

</html>