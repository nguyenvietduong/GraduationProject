<?php

return [
    'system' => [
        'button' => [
            'add' => 'Thêm',
            'addNew' => 'Thêm Mới',
            'create' => 'Tạo',
            'edit' => 'Chỉnh sửa',
            'update' => 'Cập nhật',
            'delete' => 'Xóa',
            'details' => 'Chi tiết',
            'viewCV' => 'Xem CV',
            'approve' => 'Duyệt',
            'reject' => 'Từ chối',
            'cancel' => 'Hủy',
            'clear' => 'Xóa',
            'reset' => 'Đặt lại',
            'save' => 'Lưu',
            'printCV' => 'In CV',
            'search' => 'Tìm kiếm',
            'upload' => 'Tải lên Hình ảnh',
            'previous' => 'Trước',
            'next' => 'Tiếp theo',
            'confirm' => [
                'title' => 'Bạn có chắc chắn không?',
                'text' => 'Bạn sẽ không thể hoàn tác điều này!',
                'confirmButtonText' => 'Có, tôi đồng ý!',
                'cancelButtonText' => 'Không, hủy!',
                'cancelled' => [
                    'title' => 'Đã hủy',
                    'text' => 'Hành động đã bị hủy.',
                ],
            ],
        ],
        'alert' => [
            'success' => 'Thành công! Nhiệm vụ đã được hoàn thành.',
            'error' => [
                'title' => 'Ôi...',
                'text' => 'Đã có điều gì đó sai!',
            ],
        ],
        'lang' => [
            'en' => 'Tiếng Anh',
            'vi' => 'Tiếng Việt',
        ],
        'table' => [
            'title' => 'Danh Sách',
            'fields' => [
                'created_at' => 'Ngày Tạo',
                'updated_at' => 'Ngày Cập Nhật',
                'action' => 'Hành Động',
            ],
        ],
        'no_data_available' => 'Không có dữ liệu',
        'start' => 'Bắt đầu',
        'end' => 'Kết thúc',
        'status' => 'Trạng thái',
        'account' => 'Tài khoản',
        'profile' => 'Thông tin',
        'setting' => 'Cài đặt',
        'login' => 'Đăng nhập',
        'logout' => 'Đăng xuất',
        'adminPage' => 'Trang quản trị'
    ],

    'welcome' => 'Chào mừng bạn đến với ứng dụng của chúng tôi!',
    'hello' => 'Xin chào',

    'time' => [
        'morning' => [
            'greeting' => 'Chào buổi sáng',
        ],
        'afternoon' => [
            'greeting' => 'Chào buổi chiều',
        ],
        'evening' => [
            'greeting' => 'Chào buổi tối',
        ],
        'night' => [
            'greeting' => 'Chúc ngủ ngon',
        ],
    ],

    'quotes' => [
        '1' => '“Cuộc sống là những gì xảy ra khi bạn đang bận rộn lập kế hoạch cho những thứ khác.” - John Lennon',
        '2' => '“Hãy sống như thể bạn sẽ chết vào ngày mai. Hãy học như thể bạn sẽ sống mãi mãi.” - Mahatma Gandhi',
        '3' => '“Thành công không phải là một điểm đến, mà là một hành trình.” - Zig Ziglar',
        '4' => '“Những điều tốt đẹp đến với những ai biết chờ đợi, nhưng chỉ có những điều còn lại của những người chịu khó.” - Abraham Lincoln',
        '5' => '“Điều duy nhất đứng giữa bạn và giấc mơ của bạn là sự sẵn lòng làm việc vì nó.” - Joel Brown',
    ],
    // Fields for Category
    'category' => [
        'title' => 'Danh Mục',
        'fields' => [
            'name' => 'Tên',
            'parent_id' => 'Danh Mục Cha',
        ],
        'index' => [
            'route' => 'admin.category.index',
        ],
        'create' => [
            'route' => 'admin.category.create',
        ],
        'store' => [
            'route' => 'admin.category.store',
        ],
        'edit' => [
            'route' => 'admin.category.edit',
        ],
        'update' => [
            'route' => 'admin.category.update',
        ],
        'destroy' => [
            'route' => 'admin.category.destroy',
        ],
    ],
    // Fields for Role
    'role' => [
        'title' => 'Vai trò',
        'fields' => [
            'name' => 'Tên vai trò',
            'accountsCount' => 'Số tài khoản',
        ],
        'role' => [
            'user' => 'Người dùng',
            'manager' => 'Giám đốc',
            'admin' => 'Quản trị viên',
        ],
        'index' => [
            'route' => 'admin.role.index',
        ],
        'create' => [
            'route' => 'admin.role.create',
        ],
        'store' => [
            'route' => 'admin.role.store',
        ],
        'edit' => [
            'route' => 'admin.role.edit',
        ],
        'update' => [
            'route' => 'admin.role.update',
        ],
        'destroy' => [
            'route' => 'admin.role.destroy',
        ],
    ],
    // Fields for Account
    'account' => [
        'status' => [
            '' => '-Trạng thái-',
            'normal' => 'Bình thường',
            'locked' => 'Đã khóa',
            'warning' => 'Cảnh báo',
        ],
        'fields' => [
            'full_name' => 'Họ Tên',
            'name_placeholder' => 'Nhập họ tên người dùng',
            'email' => 'Email',
            'email_placeholder' => 'Nhập email',
            'phone' => 'Điện thoại',
            'phone_placeholder' => 'Nhập số điện thoại',
            'total_friends' => 'Tổng số bạn bè',
            'address' => 'Địa chỉ',
            'address_placeholder' => 'Nhập địa chỉ',
            'password' => 'Mật khẩu',
            'password_placeholder' => 'Nhập mật khẩu',
            're_password' => 'Xác nhận Mật khẩu',
            're_password_placeholder' => 'Nhập lại mật khẩu',
            'role' => 'Vai trò',
            'profile_picture' => 'Ảnh đại diện',
        ],
        'user' => [
            'title' => 'Tài Khoản Khách Hàng',
            'index' => [
                'route' => 'admin.user.index',
            ],
            'create' => [
                'route' => 'admin.user.create',
            ],
            'store' => [
                'route' => 'admin.user.store',
            ],
            'edit' => [
                'route' => 'admin.user.edit',
            ],
            'update' => [
                'route' => 'admin.user.update',
            ],
            'destroy' => [
                'route' => 'admin.user.destroy',
            ],
        ],
        'staff' => [
            'title' => 'Tài khoản nhân viên',
            'index' => [
                'route' => 'admin.staff.index',
            ],
            'create' => [
                'route' => 'admin.staff.create',
            ],
            'store' => [
                'route' => 'admin.staff.store',
            ],
            'edit' => [
                'route' => 'admin.staff.edit',
            ],
            'update' => [
                'route' => 'admin.staff.update',
            ],
            'destroy' => [
                'route' => 'admin.staff.destroy',
            ],
        ],
        'admin' => [
            'title' => 'Tài Khoản Quản Trị',
            'index' => [
                'route' => 'admin.admin.index',
            ],
            'create' => [
                'route' => 'admin.admin.create',
            ],
            'store' => [
                'route' => 'admin.admin.store',
            ],
            'edit' => [
                'route' => 'admin.admin.edit',
            ],
            'update' => [
                'route' => 'admin.admin.update',
            ],
            'destroy' => [
                'route' => 'admin.admin.destroy',
            ],
        ],
    ],

    'version' => '<b>Phiên bản</b> :version',
    'copyright' => '<strong>Bản quyền © :year <a href=":link" title=":name" target="_blank">:name</a>.</strong> Tất cả các quyền được bảo lưu.',
    'created' => 'Tạo thành công!',
    'updated' => 'Cập nhật thành công!',
    'deleted' => 'Xóa thành công!',
    'confirmDelete' => 'Bạn có chắc chắn muốn xóa mục này không?',
];
