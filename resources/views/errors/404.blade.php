<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

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
    <link href="{{ asset('frontend/assets/css/tailwind.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/assets/css/tailwind.min.css" rel="stylesheet') }}" type="text/css">
</head>

<body class="dark:bg-slate-900">
    <section class="relative bg-amber-500/5">
        <div class="container-fluid relative">
            <div class="grid grid-cols-1">
                <div class="flex flex-col min-h-screen justify-center md:px-10 py-10 px-4">
                    <div class="text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend/assets/images/logo-dark.png') }}"
                                class="mx-auto dark:hidden block" alt="">
                            <img src="{{ asset('frontend/assets/images/logo-light.png') }}"
                                class="mx-auto hidden dark:block" alt="">
                        </a>
                    </div>
                    <div class="title-heading text-center my-auto">
                        <h4
                            class="md:text-[160px] text-8xl md:leading-normal leading-normal text-slate-900/10 dark:text-white/10">
                            404!</h4>
                        <h1 class="mt-8 mb-6 md:text-5xl text-3xl font-bold">Page Not Found?</h1>
                        <p class="text-slate-400">Whoops, this is embarassing. <br> Looks like the page you were looking
                            for wasn't found.</p>

                        <div class="mt-4">
                            <a href="{{ route('home') }}"
                                class="py-2 px-5 inline-block font-medium tracking-wide border align-middle duration-500 text-base text-center bg-amber-500 hover:bg-amber-600 border-amber-500 hover:border-amber-600 text-white rounded-md">Back
                                to Home</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="mb-0 text-slate-400">©
                            <script>document.write(new Date().getFullYear())</script> Veganfry. Design with <i
                                class="mdi mdi-heart text-red-600"></i> by <a href="https://shreethemes.in/"
                                target="_blank" class="text-reset">Shreethemes</a>.
                        </p>
                    </div>
                </div>
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('frontend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins.init.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->
</body>

</html>