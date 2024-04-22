<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderAddOnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('add_ons')->insert([
            ['name' => 'Tomato Sauce', 'type' => 'Sauce', 'price' => 49, 'image' => 'images/coffee.png'],
            ['name' => 'White Rice', 'type' => 'Rice', 'price' => 25, 'image' => 'images/rice.png'],
        ]);
    }
}
