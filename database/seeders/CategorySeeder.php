<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $recordsToInsert = 50;
        $chunkSize = 10;
        for ($i = 0; $i < ceil($recordsToInsert / $chunkSize); $i++) {
            $data = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $data[] = [
                    'name' => fake()->name(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Category::insert($data);
        }
    }
}
