<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Quản Lý Nhân Viên', 'slug' => 'staff.index'],
            ['name' => 'Quản Lý Thêm Nhân Viên', 'slug' => 'staff.create'],
            ['name' => 'Quản Lý Sửa Nhân Viên', 'slug' => 'staff.edit'],

            ['name' => 'Quản Lý Người Dùng', 'slug' => 'user.index'],
            ['name' => 'Quản Lý Thêm Người Dùng', 'slug' => 'user.create'],
            ['name' => 'Quản Lý Sửa Người Dùng', 'slug' => 'user.edit'],

            ['name' => 'Quản Lý Blog', 'slug' => 'blog.index'],
            ['name' => 'Quản Lý Thêm Blog', 'slug' => 'blog.create'],
            ['name' => 'Quản Lý Sửa Blog', 'slug' => 'blog.edit'],

            ['name' => 'Quản Lý Danh Mục', 'slug' => 'category.index'],
            ['name' => 'Quản Lý Danh Thêm Mục', 'slug' => 'category.create'],
            ['name' => 'Quản Lý Danh Sửa Mục', 'slug' => 'category.edit'],

            ['name' => 'Quản Lý Mã Giảm Giá', 'slug' => 'promotion.index'],
            ['name' => 'Quản Lý Thêm Mã Giảm Giá', 'slug' => 'promotion.create'],
            ['name' => 'Quản Lý Sửa Mã Giảm Giá', 'slug' => 'promotion.edit'],

            ['name' => 'Quản Lý Lên Món', 'slug' => 'dish.index'],
            
            ['name' => 'Quản Lý Menu', 'slug' => 'menu.index'],
            ['name' => 'Quản Lý Thêm Menu', 'slug' => 'menu.create'],
            ['name' => 'Quản Lý Sửa Menu', 'slug' => 'menu.edit'],

            ['name' => 'Quản Lý Quyền', 'slug' => 'permission.index'],
            ['name' => 'Quản Lý Thêm Quyền', 'slug' => 'permission.create'],
            ['name' => 'Quản Lý Sửa Quyền', 'slug' => 'permission.edit'],

            ['name' => 'Quản Lý Đặt Chỗ', 'slug' => 'reservation.index'],

            ['name' => 'Quản Lý Review', 'slug' => 'review.index'],

            ['name' => 'Quản Lý Role', 'slug' => 'role.index'],
            ['name' => 'Quản Lý Thêm Role', 'slug' => 'role.create'],
            ['name' => 'Quản Lý Sửa Role', 'slug' => 'role.edit'],
            ['name' => 'Quản Lý Phân Quyền', 'slug' => 'role.permission'],

            ['name' => 'Quản Lý Bàn', 'slug' => 'table.index'],
            ['name' => 'Quản Lý Thêm Bàn', 'slug' => 'table.create'],
            ['name' => 'Quản Lý Sửa Bàn', 'slug' => 'table.edit'],
        ];

        DB::table('permissions')->insert($permissions);

        $rolePermissions = [];

        foreach ($permissions as $permission) {
            $permissionId = DB::table('permissions')->where('slug', $permission['slug'])->value('id');

            $rolePermissions[] = ['permission_id' => $permissionId, 'role_id' => 1];
        }

        DB::table('role_has_permissions')->insert($rolePermissions);

    }

}


