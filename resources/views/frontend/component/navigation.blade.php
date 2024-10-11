<div id="navigation">
    <!-- Navigation Menu-->
    <ul class="navigation-menu nav-light justify-end">
        <li class="has-submenu parent-menu-item {{ set_active(['null', '', 'home'], 'active', '') }}">
            <a href="{{ route('home') }}">{{ __('messages.system.front_end.navbar.home') }}</a><span class="menu-arrow"></span>
        </li>

{{--        <li><a href="aboutus.html" class="sub-menu-item">Our Story</a></li>--}}

        <li class="{{ set_active(['menu'], 'active', '') }}"><a href="{{ route('menu') }}" class="sub-menu-item">{{ __('messages.system.front_end.navbar.menu') }}</a></li>

         <li class="{{ set_active(['reservation'], 'active', '') }}"><a href="{{ route('reservation') }}" class="sub-menu-item">{{ __('messages.system.front_end.navbar.reservation') }}</a></li>

        <li class="has-submenu parent-parent-menu-item {{ set_active(['team', 'contact'], 'active', '') }}"><a href="javascript:void(0)">{{ __('messages.system.front_end.navbar.about_us.title') }}</a><span
                class="menu-arrow"></span>
            <ul class="submenu">
                <li><a href="{{route('team')}}" class="sub-menu-item">{{ __('messages.system.front_end.navbar.about_us.team') }}</a></li>
                <li><a href="{{route('contact')}}" class="sub-menu-item">{{ __('messages.system.front_end.navbar.about_us.contact_us') }}</a></li>
            </ul>
        </li>

        {{-- <li><a href="{{ route('reservation') }}" class="sub-menu-item">Reservation</a></li> --}}

        <li class="has-submenu parent-parent-menu-item">
            <a href="javascript:void(0)"> {{ App::getLocale() === 'vi' ? "VI" : "EN" }} </a>
            <span class="menu-arrow"></span>
            <ul class="submenu">
                <li><a href="#" class="sub-menu-item dropdown-item" data-language="en">{{ __('messages.system.lang.en') }}</a></li>
                <li><a href="#" class="sub-menu-item dropdown-item" data-language="vi">{{ __('messages.system.lang.vi') }}</a></li>
            </ul>
        </li>

        @if (Auth::check())
        <li class="has-submenu parent-parent-menu-item active">
            <a href="javascript:void(0)">{{ Auth::user()->full_name }}</a><span class="menu-arrow"></span>
            <ul class="submenu">
                <li><a href="{{ route('team') }}" class="sub-menu-item">{{ __('messages.system.profile')
                        }}</a></li>
                @if(Auth::user()->role && Auth::user()->role->authorities == 'admin')
                <li><a href="{{ route('admin.dashboard.index') }}" class="">{{ __('messages.system.adminPage') }}</a>
                </li>
                @endif
                <li id="custom-logout-front" style="margin-left: 20px">
                    <!-- Bootstrap 5: ms-4 applies margin-left -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="text-danger border-0 bg-transparent mb-1">
                            {{ __('messages.system.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        @else
        <li class="has-submenu parent-parent-menu-item">
            <a href="{{ route('login') }}">{{ __('messages.system.login') }}</a>
        </li>
        @endif
    </ul>
    <!--end navigation menu-->
</div>

<script src="{{ asset('frontend/assets/custom/js/set-language.js') }}"></script>
