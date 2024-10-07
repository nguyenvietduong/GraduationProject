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
                <li><a href="{{ route('team') }}" class="sub-menu-item">Teams</a></li>
                <li><a href="{{ route('contact') }}" class="sub-menu-item">Contact Us</a></li>
            </ul>
        </li>

        <li><a href="{{ route('reservation') }}" class="sub-menu-item">Reservation</a></li>
    </ul>
    <!--end navigation menu-->
</div>
