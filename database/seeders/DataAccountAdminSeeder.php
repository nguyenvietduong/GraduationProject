<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataAccountAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mảng lưu trữ người dùng và vai trò
        $users = [
            [
                'full_name' => 'Nguyễn Viết Dương',
                'phone' => '0385906406',
                'email' => 'duongnv@hblab.vn',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
            ],
            [
                'full_name' => 'Phùng Mạnh Đức',
                'phone' => '0889564869',
                'email' => 'ducpmph33321@fpt.edu.vn',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
            ],
            [
                'full_name' => 'Nguyễn Bá Cường',
                'phone' => '0865468404',
                'email' => 'Cuongato2k4@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => 'normal',
            ],
            [
                'full_name' => 'Bùi Ngọc Thanh Trúc',
                'phone' => '0975107204',
                'email' => 'trucbntdev7204@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => 'normal',
            ],
            [
                'full_name' => 'Nguyễn Huy Tân',
                'phone' => '0886635676',
                'email' => 'tandz20004@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => 'normal',
            ],
            [
                'full_name' => 'Nguyễn Thị Hương',
                'phone' => '0396416189',
                'email' => 'nguyenthihuong.qc2004@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => 'normal',
            ],
        ];

        // Chèn người dùng vào bảng users và gán vai trò admin
        foreach ($users as $user) {
            $userId = DB::table('users')->insertGetId(array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            // Gán vai trò admin cho tất cả người dùng
            DB::table('model_has_roles')->insert([
                'role_id' => 1, // ID của vai trò admin
                'model_type' => 'App\Models\User',
                'model_id' => $userId,
            ]);

            // Lấy tất cả quyền có sẵn
            $permissions = DB::table('permissions')->pluck('id');

            // Gán tất cả quyền cho người dùng admin
            foreach ($permissions as $permissionId) {
                DB::table('model_has_permissions')->insert([
                    'permission_id' => $permissionId,
                    'model_type' => 'App\Models\User',
                    'model_id' => $userId,
                ]);
            }
        }
    }
}
