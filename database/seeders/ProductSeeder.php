<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Samsung Galaxy',
                'description' => 'Samsung Brand',
                'image' => 'https://falaqfood.com/wp-content/uploads/2024/06/sundorboner-modhu-for-web-20244-scaled.jpg',
                'price' => 100
            ],
            [
                'name' => 'Apple iPhone 12',
                'description' => 'Apple Brand',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=Iphone',
                'price' => 500
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'description' => 'Google Pixel Brand',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=Google',
                'price' => 400
            ],
            [
                'name' => 'LG V10 H800',
                'description' => 'LG Brand',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=LG',
                'price' => 200
            ]
        ];

        DB::table('products')->where('name', 'Google Pixel 2 XL')->update([
            'image' => 'https://falaqfood.com/wp-content/uploads/2024/06/sundorboner-modhu-for-web-20244-scaled.jpg'
        ]);

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}

