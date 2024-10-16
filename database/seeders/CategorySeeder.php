<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
           
            [
                'name' => 'Đồ Uống',
                'slug' => Str::slug("Đồ Uống"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Món chính',
                'slug' => Str::slug("Món chính"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Món Phụ',
                'slug' => Str::slug("Món Phụ"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
}
