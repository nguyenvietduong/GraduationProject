<div class="topbar d-print-none">
    <div class="container-xxl">
        <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">

            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                <li>
                    <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                        <i class="iconoir-menu-scale"></i>
                    </button>
                </li>

                <li class="mx-3 welcome-text">
                    <h3 class="mb-0 fw-bold text-truncate">{{ getGreeting() }}, {{ Auth::check() ?
                    Auth::user()->full_name : "Null" }} !</h3>
                    <marquee>
                        <h6 class="mb-0 fw-normal text-muted text-truncate fs-14">{{ getRandomQuote() }}</h6>
                    </marquee>
                </li>
            </ul>

            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">

                @include('backend.component.search_all')

                {{-- @include('backend.component.language') --}}

                @include('backend.component.light_dark_mode')

                @include('backend.component.notification')

                @include('backend.component.auth')
            </ul>
            <!--end topbar-nav-->
        </nav>
        <!-- end navbar-->
    </div>
</div>