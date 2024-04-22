<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('food')->insert([
            [
                'category_id' => 1,
                'name' => 'Steak Fries Veggies',
                'price' => 175,
                'rating' => 5,
                'image' => 'images/steakfriesveggies.png'
            ],
            [
                'category_id' => 2,
                'name' => 'Chicken Salad',
                'price' => 172,
                'rating' => 5,
                'image' => 'images/chickensalad.png'
            ],
            [
                'category_id' => 3,
                'name' => 'Sorvetes Primavera',
                'price' => 185,
                'rating' => 5,
                'image' => 'images/sorvetes.png'
            ],
            [
                'category_id' => 2,
                'name' => 'Chicken Wings',
                'price' => 120,
                'rating' => 5,
                'image' => 'images/friedchicken.png'
            ],
        ]);
    }
}
