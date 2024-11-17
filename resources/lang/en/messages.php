<?php

return [
    'system' => [
        'button' => [
            'add' => 'Add',
            'addNew' => 'Add New',
            'create' => 'Create',
            'edit' => 'Edit',
            'update' => 'Update',
            'delete' => 'Delete',
            'details' => 'Details',
            'viewCV' => 'View CV',
            'approve' => 'Approve',
            'reject' => 'Reject',
            'cancel' => 'Cancel',
            'clear' => 'Clear',
            'reset' => 'Reset',
            'save' => 'Save',
            'printCV' => 'Print CV',
            'search' => 'Search',
            'upload' => 'Upload Image',
            'previous' => 'Previous',
            'next' => 'Next',
            'book_a_table' => 'Book a table',
            'choose_table' => 'Choose table',
            'choose_dish' => 'Choose dish',
            'change_dish' => 'Change dish',
            'update_profile' => 'Change profile',   
            'update_profiles' => 'Profile updated successfully',
            'confirm' => [
                'title' => 'Are you sure?',
                'text' => 'You won\'t be able to revert this!',
                'confirmButtonText' => 'Yes, I agree!',
                'cancelButtonText' => 'No, cancel!',
                'cancelled' => [
                    'title' => 'Cancelled',
                    'text' => 'Action has been cancelled.',
                ],
            ],
        ],
        'invoice_error' => 'The invoice code does not belong to your account.',
        'alert' => [
            'titleSuccess' => 'Success!',
            'success' => 'Success! The task has been completed.',
            'error' => [
                'title' => 'Oops...',
                'text' => 'Something went wrong!',
            ],
        ],
        'lang' => [
            'en' => 'English',
            'vi' => 'Vietnames',
        ],
        'table' => [
            'title' => 'List Of',
            'fields' => [
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'action' => 'Action',
            ],
        ],
        'menu' => [
            'adminDashboard' => 'Admin Dashboard',
            'menu' => 'Menu',
            'promotion' => 'Promotion'
        ],
        'front_end' => [
            'navbar' => [
                'home' => 'Home',
                'reservation' => 'Reservation',
                'menu' => 'Menu',
                'about_us' => [
                    'title' => 'About Us',
                    'team' => 'Team',
                    'contact_us' => 'Reviews',
                ],
            ],
            'page' => [
                'about_us' => [
                    'contact_us' => [
                        'titleHeader' => 'Reviews',
                        'title' => 'Reviews',
                        'phone' => 'Phone',
                        'email' => 'Email',
                        'location' => 'Location',
                        'form' => [
                            'title' => 'Reviews',
                            'point' => 'Your Point',
                            'comment' => 'Your Comment',
                            'sendMessage' => 'Send Message',
                        ]
                    ]
                ],
                'reservation' => [
                    'titleHeader' => 'Reserve A Table',
                    'title' => 'Reserve A Table',
                    'messages' => 'Our tables accommodate up to 6 guests. For larger group reservations, please contact us for the best possible assistance!'
                ]
            ],
        ],
        'no_data_available' => 'No data available',
        'start' => 'Start to',
        'end' => 'End from',
        'status' => 'Status',
        'account' => 'Account',
        'profile' => 'Profile',
        'setting' => 'Settings',
        'login' => 'Login',
        'logout' => 'Logout',
        'notification' => [
            'login' => [
                'success' => 'Welcome back',
                'error' => 'Please login',
                'errorNotLogin' => 'You need to log in to access this page.',
            ],
            'logout' => [
                'success' => 'You have been logged out.',
            ]
        ],
        'adminPage' => 'Admin Page',
        'buttonPermission' => 'Authorize',
        'titleNotificationReservation' => 'New table order available',
    ],

    'welcome' => 'Welcome to our application!',
    'hello' => 'Hello',

    'time' => [
        'morning' => [
            'greeting' => 'Good morning',
        ],
        'afternoon' => [
            'greeting' => 'Good afternoon',
        ],
        'evening' => [
            'greeting' => 'Good evening',
        ],
        'night' => [
            'greeting' => 'Good night',
        ],
    ],

    'quotes' => [
        '1' => '“Life is what happens when you’re busy making other plans.” - John Lennon',
        '2' => '“Live as if you were to die tomorrow. Learn as if you were to live forever.” - Mahatma Gandhi',
        '3' => '“Success is not a destination, it’s a journey.” - Zig Ziglar',
        '4' => '“Good things come to those who wait, but only the things left by those who hustle.” - Abraham Lincoln',
        '5' => '“The only thing standing between you and your dream is the willingness to work for it.” - Joel Brown',
    ],
    // Fields for Restaurant 
    'restaurant' => [
        'title' => 'Restaurant',
        'fields' => [
            'name' => 'Restaurant name',
            'name_placeholder' => 'Please fill in the restaurant name ',
            'slug' => 'Slug',
            'address' => 'Address',
            'address_placeholer' => 'Please fill in your address',
            'phone' => 'Phone',
            'phone_placeholer' => 'Please fill in your phone',
            'opening_hours' => 'Opening hours',
            'opening_hours_placeholer' => 'Please fill in your opening hours',
            'closing_time' => 'Closing time',
            'closing_time_placeholer' => 'Please fill in your closing time',
            'rating' => 'Rating',
            'rating_placeholer' => 'Please fill in your rating',
            'description' =>  'Description',
            'desciption_placeholer' => 'Please fill in your description',
            'google_map_link' => 'Google_map_link',
            'google_map_link_placeholer' => 'Please fill in your google map link',
            'image' =>  'Image',
            'restaurant_information' => 'Restaurant information',
        ]
    ],
    'menu' => [
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        'title' => 'Food',
        "filters" => [
            "start_price" => "Price to",
            "end_price" => "Price from",
            'all' => 'All'
        ],
        'fields' => [
            "name" => "Name food",
            'name_vi' => 'Food name (Vietnamese)',
            'name_en' => 'Food name (English)',
            'slug' => 'Food slug',
            'description_vi' => 'Food description (Vietnamese)',
            'description_en' => 'Food description (English)',
            'price_vi' => 'Food price',
            'price' => "Price",
            'status' => 'Status',
            'status_active' => 'Active',
            'status_inactive' => 'Inactive',
            'category_id' => 'Category',
            'image_url' => 'Food image',
            'all' => 'Tất cả',
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
    // Fields for notification
    'notification' => [
        'title' => 'Notification',
        'fields' => [
            'user_id' => 'Notifier',
            'title' => 'Title',
            'message' => 'Message',
        ],
        'index' => [
            'route' => 'admin.notification.index',
        ],
        'create' => [
            'route' => 'admin.notification.create',
        ],
        'store' => [
            'route' => 'admin.notification.store',
        ],
        'edit' => [
            'route' => 'admin.notification.edit',
        ],
        'update' => [
            'route' => 'admin.notification.update',
        ],
        'destroy' => [
            'route' => 'admin.notification.destroy',
        ],
    ],
    // Fields for Category
    'category' => [
        'title' => 'Category',
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        'fields' => [
            'name' => 'Category Name',
            'slug' => 'Slug',
            'status' => 'Status',
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
    'permission' => [
        'title' => 'Permission',
        'fields' => [
            'name' => 'Permission',
            'accountsCount' => 'Permissions Count',
        ],
        'index' => [
            'route' => 'admin.permission.index',
        ],
        'create' => [
            'route' => 'admin.permission.create',
        ],
        'store' => [
            'route' => 'admin.permission.store',
        ],
        'edit' => [
            'route' => 'admin.permission.edit',
        ],
        'update' => [
            'route' => 'admin.permission.update',
        ],
        'destroy' => [
            'route' => 'admin.permission.destroy',
        ],
    ],
    'table' => [
        'title' => 'Table',
        'status' => [
            'available' => 'Available',
            'occupied' => 'Occupied',
            'reserved' => 'Reserved',
            'out_of_service' => 'Inactive',
        ],
        'text' => [
            'position_route' => 'Table Position',
            'max_guests' => 'Max Guests',
            'back_previous' => 'Back previous'
        ],
        'fields' => [
            'id' => 'ID',
            'name' => 'Table Name',
            'name_vi' => 'Table Name VI',
            'name_en' => 'Table Name EN',
            'capacity' => 'Capacity',
            'status' => 'Status',
            'description' => 'Description',
            'description_vi' => 'Description VI',
            'description_en' => 'Description EN',
            'position' => 'Position',
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
    // Fields for Review
    'review' => [
        'title' => 'Review',
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'pending' => 'Pending',
        ],
        'fields' => [
            'name' => 'Review Name',
            'reviewsCount' => 'Reviews Count',
            'rating' => 'Rating',
            'review_creator' => 'Review Creator',
            'comment' => 'Comment',
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
    // Fields for Blog
    'blog' => [
        'title' => 'Blog',
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        'fields' => [
            'name' => 'Blog Name',
            'blogsCount' => 'Blogs Count',
            'title' => 'Title',
            'blog_creator' => 'Blog Creator',
            'slug' => 'Blog Slug',
            'content' => 'Content',
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
        'title' => 'Role',
        'fields' => [
            'name' => 'Role Name',
            'accountsCount' => 'Accounts Count',
        ],
        'role' => [
            'user' => 'User',
            'manager' => 'Manager',
            'admin' => 'Admin',
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
    'promotion' => [
        'title' => 'Promotion',
        'titleFormR' => 'Detailed Information',
        'titleFormL' => 'General Information',
        'fields' => [
            'name' => 'Name',
            'accountsCount' => 'Promotions Count',
            'code' => 'Code',
            'description' => 'Description',
            'type' => 'Type',
            'discount' => 'Discount',
            'minOrder' => 'Min Value Order',
            'maxDiscount' => 'Max Discount',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'total' => 'Total',
            'isActive' => 'Status'
        ],
        'system' => [
            'random' => 'random',
            'warning' => 'You can only make edits to the description, start date and end date',
            'cardTop' => 'General information',
            'vn' => 'Vietnamese',
            'en' => 'English',
            'cardBody' => 'Public information',
            'times' => 'times',
            'noTime' => 'There is no end date',
            'cardBot' => 'Detailed information',

        ],
        'type' => [
            'percentage' => '%',
            'fixed' => 'Cash',
        ],
        'status' => [
            '1' => 'Active',
            '2' => 'Unactive'
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
    'account' => [
        'status' => [
            'normal' => 'Normal',
            'locked' => 'Locked',
            'warning' => 'Warning',
        ],
        'fields' => [
            'full_name' => 'Full Name',
            'name_placeholder' => 'Enter fullname',
            'email' => 'Email',
            'email_placeholder' => 'Enter email',
            'phone' => 'Phone',
            'date' => 'Birthday',
            'date_bd' => 'Enter birthday',
            'phone_placeholder' => 'Enter phone',
            'total_friends' => 'Total Friends',
            'address' => 'Address',
            'address_placeholder' => 'Enter address',
            'password' => 'Password',
            'password_placeholder' => 'Enter password',
            're_password' => 'Confirm Password',
            're_password_placeholder' => 'Enter confirm password',
            'role' => 'Role',
            'profile_picture' => 'Profile Picture',
        ],
        'user' => [
            'title' => 'Account User',
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
            'title' => 'Account Staff',
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
            'title' => 'Account Admin',
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
    'reservation' => [
        'status' => [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'canceled' => 'Canceled',
            'arrived' => 'Arrived',
            'completed' => 'Completed',
        ],
        'fields' => [
            'table' => 'Table',
            'full_name' => 'Full Name',
            'name_placeholder' => 'Enter fullname',
            'email' => 'Email',
            'email_placeholder' => 'Enter email',
            'phone' => 'Phone',
            'date' => 'Date',
            'time' => 'Time',
            'reservation_time' => 'Booking time',
            'phone_placeholder' => 'Enter phone',
            'guests' => 'Guests',
            'guests_placeholder' => 'Enter guests',
            'special_request' => 'Note',
            'special_request_placeholder' => 'Enter note',
            'reservation_information' => 'Reservation information',
            'dish' => 'Dish'
        ],
        'index' => [
            'route' => 'admin.reservation.index',
        ],
        'create' => [
            'route' => 'admin.reservation.create',
        ],
        'store' => [
            'route' => 'admin.reservation.store',
        ],
        'edit' => [
            'route' => 'admin.reservation.edit',
        ],
        'update' => [
            'route' => 'admin.reservation.update',
        ],
        'destroy' => [
            'route' => 'admin.reservation.destroy',
        ],
    ],
    'reservation_details' => [
        'fields' => [
            'table_id' => 'Table',
            'guests_detail' => 'Guests',
        ],
    ],
    'invoice' => [
        'title' => 'Invoice',
        'status' => [
            'unpaid' => 'Un paid',
            'paid' => 'Paid',
            'canceled' => 'Canceled',
        ],
        'payment_method' => [
          'cash' => 'Cash',
          'bank' => 'Bank'  
        ],
        'fields' => [
            'total_amount' => 'Total amount',
            'payment_method' => 'Payment method',
            'status' => 'Status',

            'menu' => 'Menu',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
        ],

        'index' => [
            'route' => 'admin.invoice.index',
        ],
        'detail' => [
            'route' => 'admin.invoice.detail',
        ],
    ],
    'version' => '<b>Version</b> :version',
    'copyright' => '<strong>Copyright © :year <a href=":link" title=":name" target="_blank">:name</a>.</strong> All rights reserved.',
    'created' => 'Created successfully!',
    'updated' => 'Updated successfully!',
    'deleted' => 'Deleted successfully!',
    'confirmDelete' => 'Are you sure you want to delete this item?',
];

