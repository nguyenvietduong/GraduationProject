@php
$segment = request()->segment(2);
@endphp
<!-- Bắt đầu startbar-menu -->
<div class="startbar-menu">
    <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
        <div class="d-flex align-items-start flex-column w-100">
            <!-- Điều hướng -->
            <ul class="navbar-nav mb-auto w-100">
                <li class="menu-label pt-0 mt-0">
                    <span>Menu Chính</span>
                </li>

                <!-- Nhà hàng -->
                <li class="nav-item {{ set_active(['restaurants', 'admin']) }}" style="display: {{ checkBladeAdmin() }}">
                    <a class="nav-link" href="{{ route('admin.restaurants') }}">
                        <i class="fas fa-store-alt menu-icon"></i>
                        <span>Nhà hàng</span>
                    </a>
                </li>

                <!-- Bảng điều khiển Admin -->
                <li class="nav-item {{ set_active(['dashboard', 'admin']) }}">
                    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                        <i class="fa fa-tachometer menu-icon"></i>
                        <span>{{ __('messages.system.menu.adminDashboard') }}</span>
                    </a>
                </li>

                <!-- Quản lý Tài khoản -->
                <li class="nav-item" style="display: {{ checkBladeAdmin() }}">
                    <a class="nav-link {{ set_active(['user', 'staff', 'admin', 'role', 'permission'], 'active', 'admin') }}"
                        href="#sidebarAccountManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarAccountManagement">
                        <i class="fa fa-users menu-icon"></i>
                        <span>Tài khoản</span>
                    </a>
                    <div class="collapse {{ set_active(['user', 'staff', 'admin', 'role', 'permission'], 'show', 'admin') }}"
                        id="sidebarAccountManagement">
                        <ul class="nav flex-column">
                            <li class="nav-item checkPermissionMenu">
                                <a class="nav-link {{ set_active(['user'], 'active', 'admin') }}"
                                    href="{{ route('admin.user.index') }}">
                                    <i class="fa fa-user menu-icon"></i>
                                    <span>Khách hàng</span>
                                </a>
                            </li>
                            <li class="nav-item checkPermissionMenu">
                                <a class="nav-link {{ set_active(['staff'], 'active', 'admin') }}"
                                    href="{{ route('admin.staff.index') }}">
                                    <i class="fas fa-user-friends menu-icon"></i>
                                    <span>Nhân viên</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item checkPermissionMenu">
                                <a class="nav-link {{ set_active(['admin'], 'active', 'admin') }}"
                            href="{{ route('admin.admin.index') }}">
                            <i class="fa fa-user-tie menu-icon"></i>
                            <span>Quản trị viên</span>
                            </a>
                </li> --}}
                <li class="nav-item checkPermissionMenu">
                    <a class="nav-link {{ set_active(['role'], 'active', 'admin') }}"
                        href="{{ route('admin.role.index') }}">
                        <i class="fas fa-key menu-icon"></i>
                        <span>Vai trò</span>
                    </a>
                </li>
                <li class="nav-item checkPermissionMenu">
                    <a class="nav-link {{ set_active(['permission'], 'active', 'admin') }}"
                        href="{{ route('admin.permission.index') }}">
                        <i class="fas fa-lock menu-icon"></i>
                        <span>Quyền hạn</span>
                    </a>
                </li>
            </ul>
        </div>
        </li>

        <!-- Hệ thống -->
        <li class="nav-item" style="display: {{ checkBladeAdmin(3) }}">
            <a class="nav-link {{ set_active(['menu', 'category'], 'active', 'admin') }}"
                href="#sidebarFoodManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                aria-controls="sidebarFoodManagement">
                <i class="fa fa-utensils menu-icon"></i> <!-- Icon thực phẩm -->
                <span>Thực phẩm</span>
            </a>
            <div class="collapse {{ set_active(['category', 'menu'], 'show', 'admin') }}"
                id="sidebarFoodManagement">
                <ul class="nav flex-column">
                    <li class="nav-item checkPermissionMenu">
                        <a class="nav-link {{ set_active(['category'], 'active', 'admin') }}"
                            href="{{ route('admin.category.index') }}">
                            <i class="fa fa-list menu-icon"></i>
                            <span>Danh mục</span>
                        </a>
                    </li>
                    <li class="nav-item checkPermissionMenu">
                        <a class="nav-link {{ set_active(['menu'], 'active', 'admin') }}"
                            href="{{ route('admin.menu.index') }}">
                            <i class="fa fa-utensils menu-icon"></i>
                            <span>Thực đơn</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item" style="display: {{ checkBladeAdmin(2) }}">
            <a class="nav-link {{ set_active(['table'], 'active', 'admin') }}"
                href="{{ route('admin.table.index') }}">
                <i class="fa fa-table menu-icon"></i>
                <span>Bàn</span>
            </a>
        </li>

        <li class="nav-item" style="display: {{ checkBladeAdmin(2) }}">
            <a class="nav-link {{ set_active(['reservation'], 'active', 'admin') }}"
                href="{{ route('admin.reservation.index') }}">
                <i class="fa fa-calendar-check menu-icon"></i>
                <span>Đặt chỗ</span>
            </a>
        </li>
        <li class="nav-item" style="display: {{ checkBladeAdmin(2) }}">
            <a class="nav-link {{ set_active(['invoice'], 'active', 'admin') }}"
                href="{{ route('admin.invoice.index') }}">
                <i class="fa fa-file-invoice menu-icon"></i>
                <span>Hóa đơn</span>
            </a>
        </li>
        <li class="nav-item" style="display: {{ checkBladeAdmin(3) }}">
            <a class="nav-link {{ set_active(['dish'], 'active', 'admin') }}"
                href="{{ route('admin.dish.index') }}">
                <i class="fa fa-calendar-check menu-icon"></i>
                <span>Lên món</span>
            </a>
        </li>
        <!-- <li class="nav-item" style="display: {{ checkBladeAdmin() }}"> -->

        <li class="nav-item checkPermissionMenu" style="display: {{ checkBladeAdmin() }}">
            <a class="nav-link {{ set_active(['blog'], 'active', 'admin') }}"
                href="{{ route('admin.blog.index') }}">
                <i class="fa fa-newspaper menu-icon"></i>
                <span>Bài viết</span>
            </a>
        </li>
        {{-- Khuyến mãi --}}
        <li class="nav-item checkPermissionMenu" style="display: {{ checkBladeAdmin() }}">
            <a class="nav-link {{ set_active(['promotion', 'admin']) }}"
                href="{{ route('admin.promotion.index') }}">
                <i class="fa fa-tachometer menu-icon"></i>
                <span>{{ __('messages.system.menu.promotion') }}</span>
            </a>
        </li>

        <li class="nav-item" style="display: {{ checkBladeAdmin() }}">
            <a class="nav-link {{ set_active(['review'], 'active', 'admin') }}"
                href="{{ route('admin.review.index') }}">
                <i class="fa fa-comments menu-icon"></i>
                <span id="new-review-count">Đánh giá ({{ $newReviewCount }})</span>
            </a>
        </li>

        <li class="nav-item" style="display: {{ checkBladeAdmin() }}">
            <a class="nav-link {{ set_active(['statistical'], 'active', 'admin', 2) }}"
                href="#sidebarStatistical" data-bs-toggle="collapse" role="button" aria-expanded="false"
                aria-controls="sidebarStatistical">
                <i class="fa fa-chart-bar menu-icon"></i>
                <span>Thống kê</span>
            </a>
            <div class="collapse {{ set_active(['statistical'], 'show', 'admin', 2) }}"
                id="sidebarStatistical">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ set_active(['revenue'], 'active', 'admin', 3) }}"
                            href="{{ route('admin.statistical.index') }}">
                            <i class="fa fa-dollar-sign menu-icon"></i>
                            <span>Doanh thu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ set_active(['client'], 'active', 'admin', 3) }}"
                            href="{{ route('admin.statistical.client') }}">
                            <i class="fa fa-user menu-icon"></i>
                            <span>Khách hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ set_active(['reservations'], 'active', 'admin', 3) }}"
                            href="{{ route('admin.statistical.reservations') }}">
                            <i class="fa fa-calendar-alt menu-icon"></i>
                            <span>Đơn hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ set_active(['menu'], 'active', 'admin', 3) }}"
                            href="{{ route('admin.statistical.menu') }}">
                            <i class="fa fa-utensils menu-icon"></i>
                            <span>Món ăn</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Hệ thống -->
        <li class="nav-item">
            <a class="nav-link" href="#sidebarSystemManagement" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="sidebarSystemManagement">
                <i class="fa fa-cogs menu-icon"></i>
                <span>Hệ thống</span>
            </a>
            <div class="collapse" id="sidebarSystemManagement">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa-arrow-left menu-icon"></i>
                            <span>Quay lại HuongViet</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        </ul>
        <!-- Kết thúc navbar-nav -->
    </div>
    <!-- Kết thúc d-flex -->
</div>
<!-- Kết thúc startbar-collapse -->
</div>
<!-- Kết thúc startbar-menu -->