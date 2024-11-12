<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<!-- Mirrored from shreethemes.in/veganfry/layouts/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:26 GMT -->

<head>
    <meta charset="UTF-8">
    <title>Veganfry - Food & Restaurant Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Food & Restaurant Template" name="description">
    <meta content="Shop, Fashion, eCommerce, Cart, Shop Cart, tailwind css, Admin, Landing" name="keywords">
    <meta name="author" content="Shreethemes">
    <meta name="website" content="https://shreethemes.in/">
    <meta name="email" content="support@shreethemes.in">
    <meta name="version" content="1.0.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">

    <!-- Css -->
    <!-- Main Css -->
    <link href="{{ asset('frontend/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/assets/css/tailwind.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/assets/css/customer.css') }}" rel="stylesheet" type="text/css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="dark:bg-slate-900">

    <section
        class="relative md:h-screen py-36 flex items-center bg-[url('../../assets/images/bg/bg1.jpg')] bg-center bg-no-repeat bg-cover">
        <div class="container relative">
            <div class="flex">
                @yield('content')
            </div>
        </div>
    </section>

    <div class="fixed bottom-3 end-3">
        <a href="#" class="back-button size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-full">
            <i data-feather="arrow-left" class="h-4 w-4"></i>
        </a>
    </div>

    <!-- Switcher -->
    <div class="fixed top-1/4 -left-2 z-50">
        <span class="relative inline-block rotate-90">
            <input type="checkbox" class="checkbox opacity-0 absolute" id="chk">
            <label
                class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8"
                for="chk">
                <i data-feather="moon" class="w-[18px] h-[18px] text-yellow-500"></i>
                <i data-feather="sun" class="w-[18px] h-[18px] text-yellow-500"></i>
                <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] w-7 h-7"></span>
            </label>
        </span>
    </div>

    <!-- JAVASCRIPTS -->
    <script src="/frontend/assets/libs/feather-icons/feather.min.js"></script>
    <script src="/frontend/assets/js/plugins.init.js"></script>
    <script src="/frontend/assets/js/app.js"></script>

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: "{{ __('messages.system.alert.error.title') }}", // Chuyển đổi chuỗi dịch qua Blade
            text: "{{ session('error') }}",
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ __('messages.system.alert.titleSuccess') }}", // Chuyển đổi chuỗi dịch qua Blade
            text: "{{ session('success') }}",
        });
    </script>
    @endif

    <!-- JAVASCRIPTS -->
</body>

</html>