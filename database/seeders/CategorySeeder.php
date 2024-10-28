<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Hash;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id'   => 1,
                'name' => json_encode([
                    'vi' => 'Bữa sáng',
                    'en' => 'Breakfast'
                ]),
                'slug' => 'breakfast',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'   => 2,
                'name' => json_encode([
                    'vi' => 'Bữa trưa',
                    'en' => 'Lunch'
                ]),
                'slug' => 'lunch',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'   => 3,
                'name' => json_encode([
                    'vi' => 'Bữa tối',
                    'en' => 'Dinner'
                ]),
                'slug' => 'dinner',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'   => 4,
                'name' => json_encode([
                    'vi' => 'Đồ uống',
                    'en' => 'Beverages'
                ]),
                'slug' => 'beverages',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
