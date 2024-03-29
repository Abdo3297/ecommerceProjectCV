<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminRolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // create permission
        $adminPermissions = [

            'add_role',
            'show_role',
            'edit_role',
            'delete_role',

            'add_permission',
            'show_permission',
            'edit_permission',
            'delete_permission',

            'assignPermissionsToRole',
            'revokePermissionsFromRole',
            
            'add_category',
            'show_category',
            'edit_category',
            'delete_category',
            'search_category',

            'add_product',
            'show_product',
            'edit_product',
            'delete_product',
            'search_product',


            'show_statistics',
            
        ];
        foreach ($adminPermissions as $permission) {
            Permission::Create( [
                'name' => $permission,
                'guard_name' => 'adminapi',
            ]);
        }

        // create role
        $admin_role = Role::updateOrCreate(['name' => 'admin'], [
            'name' => 'admin',
            'guard_name' => 'adminapi',
        ]);

        // give permissions to role
        $admin_role->givePermissionTo($adminPermissions);

        // give role to user
        $admin = Admin::create([
            'name' => 'abdo',
            'email' => 'abdo@abdo.com',
            'password' => Hash::make('abdo@abdo.com'),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $admin->assignRole($admin_role);
    }
}