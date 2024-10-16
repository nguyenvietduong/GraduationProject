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
                'name' => 'Breakfast',
                'slug' => 'breakfast',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'   => 2,
                'name' => 'Lunch',
                'slug' => 'lunch',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'   => 3,
                'name' => 'Dinner',
                'slug' => 'dinner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'   => 4,
                'name' => 'Tea Coffee',
                'slug' => 'tea-coffee',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('menus')->insert([
            [
                'name' => 'Rau muong sao toi',
                'slug' => 'rau-muong-sao-toi',
                'description' => 'description menu',
                'price' => '1',
                'category_id' => '1',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dau phu luot song',
                'slug' => 'dau-phu-luot-song',
                'description' => 'description menu',
                'price' => '1.2',
                'category_id' => '1',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Thanh long sao toi',
                'slug' => 'thanh-long-sao-toi',
                'description' => 'description menu',
                'price' => '2',
                'category_id' => '1',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ca chep hoa rong',
                'slug' => 'ca-chep-hoa-rong',
                'description' => 'description menu',
                'price' => '4',
                'category_id' => '2',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Thit kho ap chao',
                'slug' => 'thit-kho-ap-chao',
                'description' => 'description menu',
                'price' => '3.5',
                'category_id' => '2',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ga nuong giay bac',
                'slug' => 'ga-nuong-giay-bac',
                'description' => 'description menu',
                'price' => '4.5',
                'category_id' => '2',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cocacola',
                'slug' => 'cocacola',
                'description' => 'description menu',
                'price' => '0.5',
                'category_id' => '4',
                'image_url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
