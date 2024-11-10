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
                'position' => '0',
            ],
            [
                'name' => json_encode(['en' => 'Table 2', 'vi' => 'Bàn 2']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'Corner table', 'vi' => 'Bàn ở góc']),
                'position' => 1,
            ],
        ];

        DB::table('tables')->insert($tables);
    }
}
