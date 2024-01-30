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
        $recordsToInsert = 50;
        $chunkSize = 10;
        $categoryIds = Category::pluck('id')->toArray();
        for ($i = 0; $i < ceil($recordsToInsert / $chunkSize); $i++) {
            $data = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $data[] = [
                    'name' => fake()->name(),
                    'price' => fake()->randomNumber(5, true),
                    'category_id' => fake()->randomElement($categoryIds),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Product::insert($data);
        }
    }
}
