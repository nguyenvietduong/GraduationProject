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
        'invoice_error' => 'Mã hóa đơn không thuộc về tài khoản của bạn.',
        'alert' => [
            'titleSuccess' => 'Thành công!',
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
        'menu' => [
            'adminDashboard' => 'Quản trị',
            'menu' => 'Thực đơn',
            'promotion' => 'Mã giảm giá'

        ],
        'front_end' => [
            'navbar' => [
                'home' => 'Trang Chủ',
                'reservation' => 'Đặt Chỗ',
                'menu' => 'Thực Đơn',
                'about_us' => [
                    'title' => 'Về Chúng Tôi',
                    'team' => 'Đội Ngũ',
                    'contact_us' => 'Đánh giá',
                ],
            ],

            'page' => [
                'about_us' => [
                    'contact_us' => [
                        'titleHeader' => 'Đánh Giá',
                        'title' => 'Đánh Giá',
                        'phone' => 'Số Điện Thoại',
                        'email' => 'Email',
                        'location' => 'Địa Điểm',
                        'form' => [
                            'title' => 'Đánh Giá',
                            'point' => 'Điểm Đánh Giá Của Bạn',
                            'comment' => 'Nhận Xét Của Bạn',
                            'sendMessage' => 'Gửi tin nhắn',
                        ]
                    ]
                ]
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
        'notification' => [
            'login' => [
                'success' => 'Chào mừng trở lại',
                'error' => 'Vui lòng đăng nhập',
            ],
            'logout' => [
                'success' => 'Bạn đã đăng xuất.',
                'error' => 'Bạn cần đăng nhập để truy cập trang này.',
            ]
        ],
        'adminPage' => 'Trang quản trị',
        'buttonPermission' => 'Phân quyền chức năng'
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
    'menu' => [
        'title' => 'Món ăn',
        "filters" => [
            "start_price" => "Giá từ",
            "end_price" => "Giá đến"
        ],
        'status' => [
            'active' => 'Hoạt động',
            'inactive' => 'Tạm dừng',
        ],
        'fields' => [
            'name_vi' => 'Tên món ăn (Tiếng việt)',
            'name_en' => 'Tên món ăn (Tiếng anh)',
            'slug' => 'Đường dẫn',
            'name' => "Tên món ăn",
            'description_vi' => 'Mô tả món ăn (Tiếng việt)',
            'description_en' => 'Mô tả món ăn (Tiếng anh)',
            'price_vi' => 'Giá món ăn (Tiếng việt)',
            'price_en' => 'Giá món ăn (tiếng anh)',
            "price" => "Giá",
            'status' => 'Trạng thái',
            'status_active' => 'Hoạt động',
            'status_inactive' => 'Không hoạt động',
            'category_id' => 'Danh mục',
            'image_url' => 'Hình ảnh ',
        ],
        'index' => [
            'route' => 'admin.menu.index',
        ],
        'create' => [
            'route' => 'admin.menu.create',
        ],
        'store' => [
            'route' => 'admin.menu.store',
        ],
        'edit' => [
            'route' => 'admin.menu.edit',
        ],
        'update' => [
            'route' => 'admin.menu.update',
        ],
        'destroy' => [
            'route' => 'admin.menu.destroy',
        ],
    ],

    // Fields for Category
    'category' => [
        'title' => 'Danh Mục',
        'status' => [
            'active' => 'Hoạt động',
            'inactive' => 'Không hoạt động',
        ],
        'fields' => [
            'name' => 'Tên',
            'slug' => 'Đường dẫn',
            'status' => 'Trạng thái',
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
    'table' => [
        'title' => 'Bàn',
        'status' => [
            'available' => 'Còn chỗ',
            'occupied' => 'Đang dùng',
            'reserved' => 'Có người đặt',
            'out_of_service' => 'Không hoạt động',
        ],
        'text' => [
            'position_route' => 'Vị trí bàn',
            'max_guests' => 'Số khách tối đa',
            'back_previous' => 'Trở về'
        ],
        'fields' => [
            'id' => 'ID',
            'name' => 'Tên bàn',
            'name_vi' => 'Tên bàn VI',
            'name_en' => 'Tên bàn EN',
            'capacity' => 'Số người',
            'status' => 'Trạng thái bàn',
            'description' => 'Mô tả',
            'description_vi' => 'Mô tả VI',
            'description_en' => 'Mô tả EN',
            'position' => 'Vị trí bàn',

        ],

        'index' => [
            'route' => 'admin.table.index',
        ],
        'create' => [
            'route' => 'admin.table.create',
        ],
        'store' => [
            'route' => 'admin.table.store',
        ],
        'edit' => [
            'route' => 'admin.table.edit',
        ],
        'update' => [
            'route' => 'admin.table.update',
        ],
        'destroy' => [
            'route' => 'admin.table.destroy',
        ],
    ],
    'promotion' => [
        'title' => 'Permission',
        'titleFormR' => 'Thông tin chi tiết',
        'titleFormL' => 'Thông tin chung',
        'fields' => [
            'name' => 'Tên',
            'code' => 'Mã giảm giá',
            'description' => 'Mô tả',
            'type' => 'Chọn loại giảm giá',
            'discount' => 'Số tiền giảm',
            'minOrder' => 'Số tiền tối thiểu',
            'maxDiscount' => 'Tiền giảm tối đa',
            'startDate' => 'Ngày bắt đầu',
            'endDate' => 'Ngày kết thúc',
            'total' => 'Số lượng',
            'isActive' => 'Trạng thái'
        ],
        'system' => [
            'random' => 'ngẫu nhiên',
            'warning' => 'Bạn chỉ có thể thực hiện chỉnh sửa mô tả, ngày bắt đầu và ngày kết thúc',
            'cardTop' => 'Thông tin tổng quát',
            'vn' => 'Tiếng Việt',
            'en' => 'Tiếng Anh',
            'cardBody' => 'Thông tin chung',
            'times' => 'lần',
            'noTime' => 'Không có ngày kết thúc',
            'cardBot' => 'Thông tin chi tiết',

        ],
        'type' => [
            'percentage' => '%',
            'fixed' => 'Tiền mặt',
        ],
        'status' => [
            '1' => 'Kích hoạt',
            '2' => 'Không kích hoạt'
        ],
        'index' => [
            'route' => 'admin.promotion.index',
        ],
        'create' => [
            'route' => 'admin.promotion.create',
        ],
        'store' => [
            'route' => 'admin.promotion.store',
        ],
        'edit' => [
            'route' => 'admin.promotion.edit',
        ],
        'update' => [
            'route' => 'admin.promotion.update',
        ],
        'destroy' => [
            'route' => 'admin.promotion.destroy',
        ],
    ],
    // Fields for Account

    // Restaurant 
    'restaurant' => [
        'title' => 'Nhà hàng',
        'fields' => [
            'name' => 'Tên nhà hàng',
            'name_placeholder' => 'Vui lòng điền tên nhà hàng ',
            'slug' => 'Đường dẫn',
            'address' => 'Địa chỉ',
            'address_placeholer' => 'Vui lòng điền địa chỉ',
            'phone' => 'Số điện thoại',
            'phone_placeholer' => 'Vui lòng điền số điện thoại',
            'opening_hours' => 'Giờ mở cửa',
            'opening_hours_placeholer' => 'Vui lòng điền thời gian mở cửa',
            'closing_time' => 'Giờ đóng cửa',
            'closing_time_placeholer' => 'Vui lòng điền thời gian đóng cửa',
            'rating' => 'Đánh giá',
            'rating_placeholer' => 'Vui lòng điền đánh giá',
            'description' => 'Miêu tả',
            'desciption_placeholer' => 'Vui lòng điền miêu tả',
            'google_map_link' => 'Bản đồ',
            'google_map_link_placeholer' => 'Vui lòng điền liên kết bản đồ',
            'image' => 'Hình ảnh',
            'restaurant_information' => 'Thông tin nhà hàng',
        ],

        // Fields for Review
        'review' => [
            'title' => 'Đánh Giá',
            'status' => [
                'active' => 'Đang hoạt động',
                'inactive' => 'Ngừng hoạt động',
                'pending' => 'Chờ phê duyệt',
            ],
            'fields' => [
                'name' => 'Tên Đánh Giá',
                'reviewsCount' => 'Số Lượng Đánh Giá',
                'rating' => 'Xếp Hạng',
                'review_creator' => 'Người Tạo Đánh Giá',
                'comment' => 'Bình Luận',
            ],
            'index' => [
                'route' => 'admin.review.index',
            ],
            'edit' => [
                'route' => 'admin.review.edit',
            ],
            'update' => [
                'route' => 'admin.review.update',
            ],
            'destroy' => [
                'route' => 'admin.review.destroy',
            ],
        ],
        // Trường cho Blog
        'blog' => [
            'title' => 'Blog',
            'status' => [
                'active' => 'Hoạt động',
                'inactive' => 'Không hoạt động',
            ],
            'fields' => [
                'name' => 'Tên Blog',
                'accountsCount' => 'Số Lượng Blog',
                'title' => 'Tiêu Đề',
                'blog_creator' => 'Người Tạo Blog',
                'slug' => 'Đường Dẫn Tĩnh',
                'content' => 'Nội Dung',
            ],
            'index' => [
                'route' => 'admin.blog.index',
            ],
            'create' => [
                'route' => 'admin.blog.create',
            ],
            'store' => [
                'route' => 'admin.blog.store',
            ],
            'edit' => [
                'route' => 'admin.blog.edit',
            ],
            'update' => [
                'route' => 'admin.blog.update',
            ],
            'destroy' => [
                'route' => 'admin.blog.destroy',
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
                'date' => 'Ngày sinh',
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
    ]
];
