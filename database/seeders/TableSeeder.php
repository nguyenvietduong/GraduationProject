<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            [
                'name' => 'Bàn 1',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Gần cửa sổ',
                'position' => 0,
            ],
            [
                'name' => 'Bàn 2',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Bàn ở góc',
                'position' => 1,
            ],
            [
                'name' => 'Bàn 3',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Gần cửa vào',
                'position' => 2,
            ],
            [
                'name' => 'Bàn 4',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Giữa phòng',
                'position' => 3,
            ],
            [
                'name' => 'Bàn 5',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Cạnh quầy bar',
                'position' => 4,
            ],
            [
                'name' => 'Bàn 6',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Khu vực riêng',
                'position' => 5,
            ],
            [
                'name' => 'Bàn 7',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Gần nhà vệ sinh',
                'position' => 6,
            ],
            [
                'name' => 'Bàn 8',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Giữa phòng',
                'position' => 7,
            ],
            [
                'name' => 'Bàn 9',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Ngoài trời',
                'position' =>8,
            ],
            [
                'name' => 'Bàn 10',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Khu vực VIP',
                'position' => 9,
            ],
            [
                'name' => 'Bàn 11',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Khu vực VIP',
                'position' => 10,
            ],
            [
                'name' => 'Bàn 12',
                'capacity' => 6,
                'status' => 'available',
                'description' => 'Khu vực VIP',
                'position' => 11,
            ],
        ];

        DB::table('tables')->insert($tables);
    }
}
