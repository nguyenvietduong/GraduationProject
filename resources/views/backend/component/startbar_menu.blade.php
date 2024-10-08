@php
$segment = request()->segment(2);
// dd($segment)
@endphp
<!--start startbar-menu-->
<div class="startbar-menu">
    <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
        <div class="d-flex align-items-start flex-column w-100">
            <!-- Navigation -->
            <ul class="navbar-nav mb-auto w-100">
                <li class="menu-label pt-0 mt-0">
                    <span>Main Menu</span>
                </li>

                <!-- Admin Dashboard -->
                <li class="nav-item {{ set_active(['dashboard', 'admin']) }}">
                    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                        <i class="fa fa-tachometer menu-icon"></i>
                        <span>{{ __('messages.system.menu.adminDashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ set_active(['user', 'staff', 'admin', 'role', 'permission'], 'active', 'admin') }}"
                        href="#sidebarAccountManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarAccountManagement">
                        <i class="fa fa-users menu-icon"></i>
                        <span>Account Management</span>
                    </a>
                    <div class="collapse {{ set_active(['user', 'staff', 'admin', 'role', 'permission'], 'show', 'admin') }}"
                        id="sidebarAccountManagement">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['user'], 'active', 'admin') }}"
                                    href="{{ route('admin.user.index') }}">
                                    <i class="fa fa-user menu-icon"></i>
                                    <span>Customers</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['staff'], 'active', 'admin') }}"
                                    href="{{ route('admin.staff.index') }}">
                                    <i class="fas fa-user-friends menu-icon"></i> <!-- Thay đổi icon ở đây -->
                                    <span>Staffs</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['admin'], 'active', 'admin') }}"
                                    href="{{ route('admin.admin.index') }}">
                                    <i class="fa fa-user-tie menu-icon"></i>
                                    <span>Admins</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['role'], 'active', 'admin') }}"
                                    href="{{ route('admin.role.index') }}">
                                    <i class="fas fa-key menu-icon"></i>
                                    <span>Roles</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['permission'], 'active', 'admin') }}"
                                    href="{{ route('admin.permission.index') }}">
                                    <i class="fas fa-lock menu-icon"></i>
                                    <span>Permissions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Menu Management -->
                <a class="nav-link {{ set_active(['menu'], 'active', 'admin') }}"
                    href="{{ route('admin.menu.index') }}">
                    <i class="fa fa-bars menu-icon"></i> <!-- Biểu tượng menu điều hướng -->
                    <span>{{ __('messages.system.menu.menu') }}</span> <!-- Từ "menu" ở đây hiểu là điều hướng -->
                </a>

                <!-- Tag Management -->
                {{-- <li class="nav-item {{ set_active(['tag']) }}">
                    <a class="nav-link {{ set_active(['tag'], 'active') }}" href="{{ route('admin.tag.index') }}">
                        <i class="fa fa-tag menu-icon"></i>
                        <span>Tag</span>
                    </a>
                </li>

                <!-- Post Management -->
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarPostManagement" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPostManagement">
                        <i class="fa fa-edit menu-icon"></i>
                        <span>Post</span>
                    </a>
                    <div class="collapse {{ set_active(['post', 'word'], 'show') }}" id="sidebarPostManagement">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['post'], 'active') }}"
                                    href="{{ route('admin.post.index') }}">
                                    <i class="fa fa-list menu-icon"></i>
                                    <span>Post List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['admin.word.index']) }}"
                                    href="{{ route('admin.word.index') }}">
                                    <i class="fa fa-exclamation-triangle menu-icon"></i>
                                    <span>Words Are Banned</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['admin.comment.index']) }}"
                                    href="{{ route('admin.comment.index') }}">
                                    <i class="fa fa-comments menu-icon"></i>
                                    <span>Comment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
            <!--end navbar-nav-->
        </div>
        <!--end d-flex-->
    </div>
    <!--end startbar-collapse-->
</div>
<!--end startbar-menu-->