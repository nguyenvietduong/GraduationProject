<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

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

                    {{-- <li><a href="{{ route('reservation') }}" class="sub-menu-item">Reservation</a></li> --}}

                    @if (Auth::check())
                    <li class="has-submenu parent-parent-menu-item active">
                        <a href="javascript:void(0)">{{ Auth::user()->full_name }}</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{ route('team') }}" class="sub-menu-item">{{ __('messages.system.profile')
                                    }}</a></li>
                            @if($idRoleAdmin && Auth::user()->roles->contains('id', $idRoleAdmin))
                            <li><a href="{{ route('admin.dashboard.index') }}" class="">{{
                                    __('messages.system.adminPage') }}</a></li>
                            @endif
                            <li id="custom-logout-front" style="margin-left: 20px">
                                <!-- Bootstrap 5: ms-4 applies margin-left -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="text-danger border-0 bg-transparent mb-1">
                                        {{ __('messages.system.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="has-submenu parent-parent-menu-item active">
                        <a href="{{ route('login') }}">{{ __('messages.system.login') }}</a>
                    </li>
                    @endif
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
    @include('frontend.component.footer')
    <!--end footer-->
    <!-- Footer End -->
    <!-- Switcher -->
    @include('frontend.component.lightdark')

    <!-- Back to top -->
    @include('frontend.component.backtotop')
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    @include('frontend.component.js')
    <!-- JAVASCRIPTS -->
</body>

<!-- Mirrored from shreethemes.in/veganfry/layouts/restaurant-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 13:56:14 GMT -->

</html>