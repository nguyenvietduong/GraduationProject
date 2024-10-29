<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;


class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        //
        Table::create([
            'name' => json_encode(['en' => 'Table A1', 'vi' => 'Bàn A1']), // Lưu dưới dạng JSON
            'capacity' => 4,
            'status' => 'available',
            'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']), // Lưu dưới dạng JSON
            'position' => 'A1',
        ]);

        Table::create([
            'name' => json_encode(['en' => 'Table A2', 'vi' => 'Bàn A2']),
            'capacity' => 2,
            'status' => 'occupied',
            'description' => json_encode(['en' => 'A table for two.', 'vi' => 'Bàn cho hai người.']),
            'position' => 'A2',
        ]);
    }
}
