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
            'menu' => 'Menu'
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
        'buttonPermission' => 'Authorize'
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
        'fields' => [
            'name' => 'Category Name',
            'slug' => 'Slug',
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
    'menu' => [
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        'title' => 'Food',
        "filters" => [
            "start_price" => "Price to",
            "end_price" => "Price from"
        ],
        'fields' => [
            "name" => "Name food" ,
            'name_vi' => 'Food name (Vietnamese)',
            'name_en' => 'Food name (English)',
            'slug' => 'Food slug',
            'description_vi' => 'Food description (Vietnamese)',
            'description_en' => 'Food description (English)',
            'price_vi' => 'Food price (Vietnamese)',
            'price_en' => 'Food price (English)',
            'price' => "Price",
            'status' => 'Status',
            'status_active' => 'Active',
            'status_inactive' => 'Inactive',
            'category_id' => 'Category',
            'image_url' => 'Food image',
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
    // Fields for Blog
    'blog' => [
        'title' => 'Blog',
        'fields' => [
            'name' => 'Blog Name',
            'accountsCount' => 'Blogs Count',
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

    'version' => '<b>Version</b> :version',
    'copyright' => '<strong>Copyright © :year <a href=":link" title=":name" target="_blank">:name</a>.</strong> All rights reserved.',
    'created' => 'Created successfully!',
    'updated' => 'Updated successfully!',
    'deleted' => 'Deleted successfully!',
    'confirmDelete' => 'Are you sure you want to delete this item?',
];
