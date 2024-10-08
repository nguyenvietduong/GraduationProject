<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container relative">
        <!-- Logo container-->
        <a class="logo" href="{{ route('home') }}">
            <span class="inline-block dark:hidden">
                <img src="{{ asset('frontend/assets/images/logo-dark.png') }}" class="l-dark" alt="">
                <img src="{{ asset('frontend/assets/images/logo-light.png') }}" class="l-light" alt="">
            </span>
            <img src="{{ asset('frontend/assets/images/logo-light.png') }}" class="hidden dark:inline-block"
                alt="">
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
<<<<<<< Updated upstream
        @include('frontend.component.nav-button')
=======
        @include('frontend.component.button-nav')
>>>>>>> Stashed changes
        <!--Login button End-->

        @include('frontend.component.navigation')
        <!--end navigation-->
    </div>
    <!--end container-->
</nav>
