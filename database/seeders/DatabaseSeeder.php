<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo quyền
        Permission::create(['name' => 'manage accounts']);
        Permission::create(['name' => 'view accounts']);
        Permission::create(['name' => 'edit accounts']);
        Permission::create(['name' => 'delete accounts']);

        // Tạo vai trò cho Admin và gán quyền
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(['manage accounts', 'view accounts', 'edit accounts', 'delete accounts']);

        // Tạo vai trò cho Nhân viên và chỉ gán quyền xem
        $staffRole = Role::create(['name' => 'Staff']);
        $staffRole->givePermissionTo('view accounts');

        // Tạo vai trò cho Người dùng thông thường (nếu cần)
        $userRole = Role::create(['name' => 'User']);
    }
}
