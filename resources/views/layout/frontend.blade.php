<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<!-- Mirrored from shreethemes.in/veganfry/layouts/restaurant-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:06 GMT -->

<head>
    <meta charset="UTF-8">
    <title>Hương Việt - Trang chủ</title>
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
    <link href="{{ asset('frontend/assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/libs/swiper/css/swiper.min.css') }}" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('frontend/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('frontend/assets/css/tailwind.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="dark:bg-slate-900">
    <!-- Loader Start -->
    <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
    <!-- Loader End -->
    <!-- Start Navbar -->
    {{-- @php
        $segment = request()->segment(0);
        dd($segment);
    @endphp --}}
    <nav id="topnav" class="defaultscroll is-sticky">
        <div class="container relative">
            <!-- Logo container-->
            <a class="logo" href="{{ route('home') }}">
                <span class="inline-block dark:hidden">
                    <img src="{{ asset('frontend/assets/images/logo-dark.png') }}" class="l-dark" alt="">
                    <img src="{{ asset('frontend/assets/images/logo-light.png') }}" class="l-light" alt="">
                </span>
                <img src="{{ asset('frontend/assets/images/logo-light.png') }}" class="hidden dark:inline-block" alt="">
            </a>
            <!-- End Logo container-->

            <!-- Start Mobile Toggle -->
            <div class="menu-extras">
                <div class="menu-item">
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- End Mobile Toggle -->

            <!--Login button Start-->
            <ul class="buy-button list-none mb-0">
                <li class="dropdown inline-block relative pe-1">
                    <button data-dropdown-toggle="dropdown"
                        class="dropdown-toggle align-middle inline-flex search-dropdown" type="button">
                        <i data-feather="search" class="size-5 dark-icon"></i>
                        <i data-feather="search" class="size-5 white-icon text-white"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute overflow-hidden end-0 m-0 mt-5 z-10 md:w-52 w-48 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                        onclick="event.stopPropagation();">
                        <div class="relative">
                            <i data-feather="search" class="size-4 absolute top-[9px] end-3"></i>
                            <input type="text"
                                class="h-9 px-3 pe-10 w-full border-0 focus:ring-0 outline-none bg-white dark:bg-slate-900 shadow dark:shadow-gray-800"
                                name="s" id="searchItem" placeholder="Search...">
                        </div>
                    </div>
                </li>

                <li class="dropdown inline-block relative ps-0.5">
                    <button data-dropdown-toggle="dropdown"
                        class="dropdown-toggle size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 border border-amber-500 text-white"
                        type="button">
                        <i data-feather="shopping-cart" class="h-4 w-4"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-64 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                        onclick="event.stopPropagation();">
                        <ul class="py-3 text-start" aria-labelledby="dropdownDefault">
                            <li class="py-1.5 px-4">Empty Cart</li>
                        </ul>
                    </div>
                </li>

                <li class="inline-block ps-0.5">
                    <a href="javascript:void(0)"
                        class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 text-white">
                        <i data-feather="heart" class="h-4 w-4"></i>
                    </a>
                </li>
            </ul>
            <!--Login button End-->

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu nav-light justify-end">
                    <li class="has-submenu parent-menu-item {{ set_active(['null', '', 'home'], 'active', '') }}">
                        <a href="{{ route('home') }}">Trang chủ</a><span class="menu-arrow"></span>
                    </li>                    

                    <li><a href="aboutus.html" class="sub-menu-item">Our Story</a></li>

                    <li><a href="{{ route('menu') }}" class="sub-menu-item">Menus</a></li>

                    <li class="has-submenu parent-parent-menu-item"><a href="javascript:void(0)"> Pages </a><span
                            class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="team.html" class="sub-menu-item">Our Chefs</a></li>

                            <li class="has-submenu parent-menu-item">
                                <a href="javascript:void(0)"> Blogs </a><span class="submenu-arrow"></span>
                                <ul class="submenu">
                                    <li><a href="blog-grid.html" class="sub-menu-item">Blog Grids</a></li>
                                    <li><a href="blog-standard.html" class="sub-menu-item">Blog Starndard</a></li>
                                    <li><a href="blog-list.html" class="sub-menu-item">Blog List</a></li>
                                    <li><a href="blog-detail.html" class="sub-menu-item">Blog Detail</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu parent-menu-item"><a href="javascript:void(0)"> Auth Pages
                                </a><span class="submenu-arrow"></span>
                                <ul class="submenu">
                                    <li><a href="login.html" class="sub-menu-item"> Login</a></li>
                                    <li><a href="signup.html" class="sub-menu-item"> Signup</a></li>
                                    <li><a href="forgot-password.html" class="sub-menu-item"> Forgot Password</a></li>
                                    <li><a href="lock-screen.html" class="sub-menu-item"> Lock Screen</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu parent-menu-item"><a href="javascript:void(0)"> Utility </a><span
                                    class="submenu-arrow"></span>
                                <ul class="submenu">
                                    <li><a href="terms.html" class="sub-menu-item">Terms of Services</a></li>
                                    <li><a href="privacy.html" class="sub-menu-item">Privacy Policy</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu parent-parent-menu-item"><a href="javascript:void(0)"> About Us </a><span
                            class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('team')}}" class="sub-menu-item">Teams</a></li>
                            <li><a href="{{route('contact')}}" class="sub-menu-item">Contact Us</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('reservation') }}" class="sub-menu-item">Reservation</a></li>
                </ul>
                <!--end navigation menu-->
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
    </nav>
    <!--end header-->
    <!-- End Navbar -->

    @yield('contentUser')

    <!-- Footer Start -->
    <footer class="relative bg-slate-950 dark:bg-slate-950/20 text-gray-200">
        <div class="container relative">
            <div class="grid grid-cols-12">
                <div class="col-span-12">
                    <div class="py-[60px] px-0">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 justify-center gap-6">
                            <div class="text-center">
                                <h5 class="tracking-[1px] text-gray-100 font-medium text-lg mb-4">Open Hours</h5>
                                <p class="mb-2 text-gray-200/80">Monday - Friday: 10:00AM - 11:00PM</p>
                                <p class="mb-0 text-gray-200/80">Saturday - Sunday: 9:00AM - 1:00PM</p>
                            </div>

                            <div class="text-center">
                                <h5 class="tracking-[1px] text-gray-100 font-medium text-lg mb-4">Reservation</h5>
                                <p class="mb-2"><a href="tel:+152534-468-854" class="text-gray-200/80">+152
                                        534-468-854</a></p>
                                <p class="mb-0"><a href="mailto:contact@example.com"
                                        class="text-gray-200/80">contact@example.com</a></p>
                            </div>

                            <div class="text-center">
                                <h5 class="tracking-[1px] text-gray-100 font-medium text-lg mb-4">Address</h5>
                                <p class="mb-0 text-gray-200/80">C/54 Northwest Freeway, <br> Suite 558, USA 485</p>
                            </div>
                        </div>
                        <!--end grid-->


                        <div class="grid grid-cols-1 mt-12">
                            <div class="text-center">
                                <img src="/frontend/assets/images/white-icon.png" class="block mx-auto" alt="">
                                <p class="max-w-xl mx-auto mt-6">Splash your dream color Bring your home to lively
                                    Colors. We make it a priority to offer flexible services to accomodate your needs
                                </p>
                            </div>

                            <ul class="list-none text-center mt-6">
                                <li class="inline"><a href="https://1.envato.market/veganfry" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="shopping-cart" class="size-4 align-middle"
                                            title="Buy Now"></i></a></li>
                                <li class="inline"><a href="https://dribbble.com/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="dribbble" class="size-4 align-middle"
                                            title="dribbble"></i></a></li>
                                <li class="inline"><a href="http://linkedin.com/company/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="linkedin" class="size-4 align-middle"
                                            title="Linkedin"></i></a></li>
                                <li class="inline"><a href="https://www.facebook.com/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="facebook" class="size-4 align-middle"
                                            title="facebook"></i></a></li>
                                <li class="inline"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="instagram" class="size-4 align-middle"
                                            title="instagram"></i></a></li>
                                <li class="inline"><a href="https://twitter.com/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="twitter" class="size-4 align-middle" title="twitter"></i></a>
                                </li>
                                <li class="inline"><a href="mailto:support@shreethemes.in"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                            data-feather="mail" class="size-4 align-middle" title="email"></i></a>
                                </li>
                            </ul>
                            <!--end icon-->
                        </div>
                        <!--end grid-->
                    </div>
                </div>
            </div>
            <!--end grid-->
        </div>
        <!--end container-->

        <div class="py-[30px] px-0 border-t border-slate-800">
            <div class="container relative text-center">
                <div class="grid md:grid-cols-1">
                    <p class="mb-0">©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Veganfry. Design with <i class="mdi mdi-heart text-red-600"></i> by <a
                            href="https://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.
                    </p>
                </div>
                <!--end grid-->
            </div>
            <!--end container-->
        </div>
    </footer>
    <!--end footer-->
    <!-- Footer End -->
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

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-amber-500 text-white justify-center items-center"><i
            class="mdi mdi-arrow-up"></i></a>
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('frontend/assets/libs/shufflejs/shuffle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/tobii/js/tobii.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins.init.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->
</body>

<!-- Mirrored from shreethemes.in/veganfry/layouts/restaurant-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:14 GMT -->

</html>