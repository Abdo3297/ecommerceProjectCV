<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $recordsToInsert = 1;
        $chunkSize = 1;
        for ($i = 0; $i < ceil($recordsToInsert / $chunkSize); $i++) {
            $data = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $data[] = [
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('123456789'),
                    'email_verified_at' => Carbon::now(),
                    'birth'=> Carbon::createFromFormat('d-m-Y', '31-12-1999'),
                    'remember_token' => Str::random(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Admin::insert($data);
        }
    }
}
