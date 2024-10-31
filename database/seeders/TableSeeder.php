<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        DB::table('tables')->insert([
            [
                'name' => json_encode(['en' => 'Table A1', 'vi' => 'Ban A1']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '1'
            ],
            [
                'name' => json_encode(['en' => 'Table A2', 'vi' => 'Ban A2']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '2'
            ],
            [
                'name' => json_encode(['en' => 'Table A3', 'vi' => 'Ban A3']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '3'
            ],
            [
                'name' => json_encode(['en' => 'Table A4', 'vi' => 'Ban A4']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '4'
            ],
            [
                'name' => json_encode(['en' => 'Table A5', 'vi' => 'Ban A5']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '5'
            ],
            [
                'name' => json_encode(['en' => 'Table A6', 'vi' => 'Ban A6']),
                'capacity' => 4,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '6'
            ],
            [
                'name' => json_encode(['en' => 'Table A7', 'vi' => 'Ban A7']),
                'capacity' => 6,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '7'
            ],
            [
                'name' => json_encode(['en' => 'Table A8', 'vi' => 'Ban A8']),
                'capacity' => 6,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '8'
            ],
            [
                'name' => json_encode(['en' => 'Table A9', 'vi' => 'Ban A9']),
                'capacity' => 8,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '9'
            ],
            [
                'name' => json_encode(['en' => 'Table A10', 'vi' => 'Ban A10']),
                'capacity' => 8,
                'status' => 'available',
                'description' => json_encode(['en' => 'A cozy table for four.', 'vi' => 'Bàn ấm cúng cho bốn người.']),
                'position' => '10'
            ]
        ]);
    }
}
