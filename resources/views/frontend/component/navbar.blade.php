@php
    $segment = request()->segment(1);
@endphp
<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container relative">
        <!-- Logo container-->
        <a class="logo" href="{{ route('home') }}" @if ($segment == null) style="margin-top: 10px" @endif>
            <span class="inline-block dark:hidden">
                <img src="{{ asset('frontend/assets/images/huongviet.png') }}" class="l-dark" alt="">
                <img src="{{ asset('frontend/assets/images/huongviet.png') }}" class="l-light" alt="">
            </span>
            <img src="{{ asset('frontend/assets/images/huongviet.png') }}" class="hidden dark:inline-block" alt="">
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

        @include('frontend.component.navigation')
        <!--end navigation-->
    </div>
    <!--end container-->
</nav>
