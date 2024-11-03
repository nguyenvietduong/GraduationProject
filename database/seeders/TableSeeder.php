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
                'name' => json_encode(['en' => 'Table 1', 'vi' => 'Bàn 1']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'Near window', 'vi' => 'Gần cửa sổ']),
                'position' => 'A1',
            ],
            [
                'name' => json_encode(['en' => 'Table 2', 'vi' => 'Bàn 2']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'Corner table', 'vi' => 'Bàn ở góc']),
                'position' => 'A2',
            ],
            [
                'name' => json_encode(['en' => 'Table 3', 'vi' => 'Bàn 3']),
                'capacity' => 2,
                'status' => 'available',
                'description' => json_encode(['en' => 'Near entrance', 'vi' => 'Gần cửa vào']),
                'position' => 'B1',
            ],
            [
                'name' => json_encode(['en' => 'Table 4', 'vi' => 'Bàn 4']),
                'capacity' => 2,
                'status' => 'available',
                'description' => json_encode(['en' => 'Middle of the room', 'vi' => 'Giữa phòng']),
                'position' => 'B2',
            ],
            [
                'name' => json_encode(['en' => 'Table 5', 'vi' => 'Bàn 5']),
                'capacity' => 6,
                'status' => 'available',
                'description' => json_encode(['en' => 'Next to bar', 'vi' => 'Cạnh quầy bar']),
                'position' => 'C1',
            ],
            [
                'name' => json_encode(['en' => 'Table 6', 'vi' => 'Bàn 6']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'Private area', 'vi' => 'Khu vực riêng']),
                'position' => 'C2',
            ],
            [
                'name' => json_encode(['en' => 'Table 7', 'vi' => 'Bàn 7']),
                'capacity' => 2,
                'status' => 'available',
                'description' => json_encode(['en' => 'Near restroom', 'vi' => 'Gần nhà vệ sinh']),
                'position' => 'D1',
            ],
            [
                'name' => json_encode(['en' => 'Table 8', 'vi' => 'Bàn 8']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'Middle of the room', 'vi' => 'Giữa phòng']),
                'position' => 'D2',
            ],
            [
                'name' => json_encode(['en' => 'Table 9', 'vi' => 'Bàn 9']),
                'capacity' => 6,
                'status' => 'available',
                'description' => json_encode(['en' => 'Outdoor', 'vi' => 'Ngoài trời']),
                'position' => 'E1',
            ],
            [
                'name' => json_encode(['en' => 'Table 10', 'vi' => 'Bàn 10']),
                'capacity' => 8,
                'status' => 'available',
                'description' => json_encode(['en' => 'VIP area', 'vi' => 'Khu vực VIP']),
                'position' => 'E2',
            ],
        ];

        DB::table('tables')->insert($tables);
    }
}
