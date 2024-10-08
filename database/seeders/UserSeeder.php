<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo vai trò nếu chưa có
        $userRole = Role::firstOrCreate(['name' => 'user']); // Tạo vai trò user nếu chưa tồn tại

        // Tạo người dùng mẫu
        $users = [];
        $password = Hash::make('12345678');
        $now = now();

        for ($i = 1; $i <= 2000; $i++) {
            $users[] = [
                'full_name' => 'Người dùng ' . $i,
                'phone'     => '038590' . str_pad($i, 4, '0', STR_PAD_LEFT), // Tạo số điện thoại giả
                'email'     => 'user' . $i . '@example.com',
                'password'  => $password, // Mã hóa mật khẩu
                'status'    => 'normal',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Chèn tất cả người dùng vào bảng
        DB::table('users')->insert($users);

        // Lấy ID của tất cả người dùng vừa được chèn
        $userIds = DB::table('users')->pluck('id');

        // Gán vai trò cho tất cả người dùng
        foreach ($userIds as $userId) {
            DB::table('model_has_roles')->insert([
                'role_id' => $userRole->id,
                'model_type' => 'App\Models\User',
                'model_id' => $userId,
            ]);
        }
    }
}
