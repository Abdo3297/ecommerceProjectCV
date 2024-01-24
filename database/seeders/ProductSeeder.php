<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $recordsToInsert = 1000;
        $chunkSize = 100;
        // Get all category IDs
        $categoryIds = Category::pluck('id')->toArray();
        for ($i = 0; $i < ceil($recordsToInsert / $chunkSize); $i++) {
            $data = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $data[] = [
                    'name' => fake()->name(),
                    'price' => fake()->numberBetween(100, 9999) / 100,
                    'category_id' => fake()->randomElement($categoryIds),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Product::insert($data);
        }
    }
}
