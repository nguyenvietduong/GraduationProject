<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<!-- Mirrored from shreethemes.in/veganfry/layouts/restaurant-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:06 GMT -->

<head>
    @include('frontend.component.meta')

    @include('frontend.component.css')
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
</head>

<body class="dark:bg-slate-900">
    <!-- Loader Start -->
    @include('frontend.component.loader')
    <!-- Loader End -->
    <!-- Start Navbar -->
<<<<<<< Updated upstream
    {{-- @php
        $segment = request()->segment(0);
        dd($segment);
    @endphp --}}
=======
>>>>>>> Stashed changes
    @include('frontend.component.navbar')
    <!--end header-->
    <!-- End Navbar -->

    @yield('contentUser')

    <!-- Footer Start -->
    @include('frontend.component.footer')
    <!--end footer-->
    <!-- Footer End -->
    <!-- Switcher -->
<<<<<<< Updated upstream
    @include('frontend.component.light-dark')

    <!-- Back to top -->
    @include('frontend.component.back-to-top')
=======
    @include('frontend.component.lightdark')

    <!-- Back to top -->
    @include('frontend.component.backtotop')
>>>>>>> Stashed changes
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    @include('frontend.component.js')
    <!-- JAVASCRIPTS -->
</body>

<!-- Mirrored from shreethemes.in/veganfry/layouts/restaurant-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:14 GMT -->

</html>
