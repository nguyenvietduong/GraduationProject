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
        'no_data_available' => 'No data available',
        'start' => 'Start',
        'end' => 'End',
        'account' => 'Account',
        'profile' => 'Profile',
        'setting' => 'Settings',
        'logout' => 'Logout'
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
    // Fields for Category
    'category' => [
        'title' => 'Category',
        'fields' => [
            'name' => 'Name',
            'parent_id' => 'Parent Category',
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
        'fields' => [
            'name' => 'Name',
            'name_placeholder' => 'Enter username',
            'email' => 'Email',
            'email_placeholder' => 'Enter email',
            'phone' => 'Phone',
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
