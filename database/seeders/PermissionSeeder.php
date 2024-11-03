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
            ['name' => 'Quản Lý Role', 'slug' => 'role.index'],
            ['name' => 'Phân Quyền Chức Năng', 'slug' => 'role.permission'],
            ['name' => 'Quản Lý Admin', 'slug' => 'admin.index'],
            ['name' => 'Quản Lý Cộng Tác Viên', 'slug' => 'staff.index'],
            ['name' => 'Quản Lý Khách Hàng', 'slug' => 'customer.index'],
            ['name' => 'Quản Lý Quyền', 'slug' => 'permission.index'],
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


