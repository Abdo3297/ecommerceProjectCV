<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run() :void
    {
        $recordsToInsert = 50;
        $chunkSize = 10;

        for ($i = 0; $i < ceil($recordsToInsert / $chunkSize); $i++) {
            $data = [];
            
            for ($j = 0; $j < $chunkSize; $j++) {
                $user = [
                    'name' => fake()->name(),
                    'email' => fake()->safeEmail(),
                    'birth' => Carbon::createFromFormat('d-m-Y', fake()->date('d-m-Y')),
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('Au.@8391'),
                    'provider' => null,
                    'provider_id' => null,
                    'address' => fake()->address(),
                    'remember_token' => Str::random(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $data[] = $user;

                // assign role to user
                $user_role = Role::where('name', 'user')->first();
                if ($user_role) {
                    $user_model = User::create($user);
                    $user_model->assignRole($user_role);
                }
            }

            User::insert($data);
        }
    }
}