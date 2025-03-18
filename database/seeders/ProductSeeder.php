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
                'name' => 'iPhone 15 pro max',
                'description' => 'Apple Brand',
                'image' => 'https://assets.gadgetandgear.com/upload/media/iphone-15-pro-max-blue-titanium-256gb.jpeg',
                'price' => 1149
            ],
            [
                'name' => 'Samsung Galaxy S25 Ultra',
                'description' => 'Samsung',
                'image' => 'https://cdn.vanguardngr.com/wp-content/uploads/2025/02/sam.webp',
                'price' => 1300
            ],
            [
                'name' => 'Asus-ROG-Phone-8-Pro',
                'description' => 'Asus',
                'image' => 'https://www.mobiledokan.co/wp-content/uploads/2023/04/Asus-ROG-Phone-8-Pro-Phantom-Black.webp',
                'price' => 1200
            ],

            [
                'name' => 'FX Cruiser',
                'description' => 'Yamaha',
                'image' => 'https://cdpcdn.dx1app.com/products/USA/YA/2025/PWC/PWC3STR/FX_CRUISER_HO_WITH_AUDIO/50/COPPER_-_BLACK/2000000001.jpg',
                'price' => 1500
            ],

            [
                'name' => 'Road Runner',
                'description' => 'Plymouth',
                'image' => 'https://www.motortrend.com/uploads/sites/21/2017/09/freiburger-1971-road-runner.jpg?w=768&width=768&q=75&format=webp',
                'price' => 3000
            ],
            [
                'name' => 'Cafe Racer',
                'description' => 'Triumph',
                'image' => 'https://i.pinimg.com/550x/99/63/94/99639436a41704499685c2e9405c1205.jpg',
                'price' => 1200
            ],
            [
                'name' => 'CreatorPro-X17',
                'description' => 'MSI',
                'image' => 'https://www.91-cdn.com/hub/wp-content/uploads/2024/01/MSI-CreatorPro-X17.png',
                'price' => 3000
            ],

            [
                'name' => 'Acer-Predator',
                'description' => 'Acer',
                'image' => 'https://www.91-cdn.com/hub/wp-content/uploads/2024/01/Acer-Predator-21-X-768x768.jpg',
                'price' => 9000
            ],

            [
                'name' => 'Stealth MackBook Pro',
                'description' => 'Apple',
                'image' => 'https://www.techuntold.com/wp-content/uploads/2014/09/most-expensive-laptops-apple-stealth-.jpg',
                'price' => 8000
            ]

        ];


        https://ae01.alicdn.com/kf/S2160720ae55a4aae8ccf96ba6c5d1ccae.jpg
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}

