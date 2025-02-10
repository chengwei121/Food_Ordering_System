<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class DishSeeder extends Seeder
{
    public function run()
    {
        // Create dishes directory if it doesn't exist
        Storage::disk('public')->makeDirectory('dishes');

        $dishes = [
            [
                'name' => 'Classic Burger',
                'description' => 'Juicy beef patty with fresh lettuce, tomatoes, and special sauce',
                'price' => 12.99,
                'category' => 'main_course',
                'is_available' => true,
                'image' => 'dishes/burger.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Crisp romaine lettuce, parmesan cheese, croutons with caesar dressing',
                'price' => 8.99,
                'category' => 'appetizer',
                'is_available' => true,
                'image' => 'dishes/caesar-salad.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1'
            ],
            [
                'name' => 'Chocolate Lava Cake',
                'description' => 'Warm chocolate cake with a molten chocolate center',
                'price' => 7.99,
                'category' => 'dessert',
                'is_available' => true,
                'image' => 'dishes/lava-cake.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51'
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => 'Fresh tomatoes, mozzarella, basil, and olive oil',
                'price' => 14.99,
                'category' => 'main_course',
                'is_available' => true,
                'image' => 'dishes/pizza.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1604382355076-af4b0eb60143'
            ],
            [
                'name' => 'Fresh Lemonade',
                'description' => 'Freshly squeezed lemons with mint leaves',
                'price' => 4.99,
                'category' => 'beverage',
                'is_available' => true,
                'image' => 'dishes/lemonade.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859'
            ]
        ];

        foreach ($dishes as $dish) {
            // Download and save image
            $imageContent = Http::get($dish['image_url'])->body();
            Storage::disk('public')->put($dish['image'], $imageContent);
            
            // Remove image_url before creating dish
            unset($dish['image_url']);
            Dish::create($dish);
        }
    }
} 