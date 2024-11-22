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
        
        {{-- <ul class="buy-button list-none mb-0">
            <li class="dropdown inline-block relative ps-0.5">
                <!-- Nút đặt bàn với sự kiện onclick để mở/đóng menu thả xuống -->
                <button data-dropdown-toggle="dropdown"
                    class="dropdown-toggle size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 border border-amber-500 text-white"
                    type="button" onclick="reservationHistory(event)">
                    <i data-feather="calendar" class="h-4 w-4"></i>
                </button>
                <!-- Menu thả xuống -->
                <div id="dropdownMenu"
                    class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-[400px] rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden">
                    <ul class="py-3 text-start" aria-labelledby="dropdownDefault">
                        <!-- Danh sách đơn đặt bàn sẽ được thêm vào đây -->
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Thông tin</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Số người</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Thời gian</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Trạng thái</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px"></th>
                                </tr>
                            </thead>
                            <tbody id="reservationTableBody" class="text-sm">
                                <!-- Các dòng dữ liệu sẽ được thêm vào đây -->
                            </tbody>
                        </table>
                    </ul>
                </div>
            </li>

            <li class="inline-block ps-0.5">
            </li>
        </ul> --}}
        <!--Login button End-->

        @include('frontend.component.navigation')
        <!--end navigation-->
    </div>
    <!--end container-->
</nav>
