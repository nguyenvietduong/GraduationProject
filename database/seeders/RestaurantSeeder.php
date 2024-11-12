<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'Hương Việt',
                'slug' => 'huong-viet',
                'phone' => '0385906406',
                'address' => 'FPT Polytechnic',
                'opening_hours' => '07:00',
                'closing_time' => '22:30',
                'rating' => '5',
                'description' => 'Huong Viet Restaurant brings Vietnamese flavors',
                'image' => 'restaurant_image/logo_1730131292.png',
                'google_map_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863931182066!2d105.74468687503175!3d21.038129780613545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1730130935807!5m2!1svi!2s'
            ]
        ]);
    }
}
