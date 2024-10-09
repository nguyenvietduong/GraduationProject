<div id="navigation">
    <!-- Navigation Menu-->
    <ul class="navigation-menu nav-light justify-end">
        <li class="has-submenu parent-menu-item {{ set_active(['null', '', 'home'], 'active', '') }}">
            <a href="{{ route('home') }}">Trang chủ</a><span class="menu-arrow"></span>
        </li>

        <li><a href="aboutus.html" class="sub-menu-item">Our Story</a></li>

        <li><a href="{{ route('menu') }}" class="sub-menu-item">Menus</a></li>

        <li class="has-submenu parent-parent-menu-item"><a href="javascript:void(0)"> About Us </a><span
                class="menu-arrow"></span>
            <ul class="submenu">
                <li><a href="{{route('team')}}" class="sub-menu-item">Teams</a></li>
                <li><a href="{{route('contact')}}" class="sub-menu-item">Contact Us</a></li>
            </ul>
        </li>

        {{-- <li><a href="{{ route('reservation') }}" class="sub-menu-item">Reservation</a></li> --}}

        <li class="has-submenu parent-parent-menu-item">
            <a href="javascript:void(0)"> {{ App::getLocale() === 'vi' ? __('messages.system.lang.vi') : __('messages.system.lang.en') }} </a>
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
        <li class="has-submenu parent-parent-menu-item active">
            <a href="{{ route('login') }}">{{ __('messages.system.login') }}</a>
        </li>
        @endif
    </ul>
    <!--end navigation menu-->
</div>

<script src="{{ asset('frontend/assets/custom/js/set-language.js') }}"></script>