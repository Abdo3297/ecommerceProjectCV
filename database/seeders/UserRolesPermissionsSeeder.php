<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // create permission
        $userPermissions = [
            'show_profile',
            'edit_profile',
            'delete_profile',

            'show_product',
            'show_category',
            'search_product',
            'search_category',

            'make_order',
            'show_order',
            'edit_order',
            'delete_order',
        ];
        foreach ($userPermissions as $permission) {
            Permission::Create( [
                'name' => $permission,
                'guard_name' => 'userapi',
            ]);
        }

        // create role
        $user_role = Role::updateOrCreate(['name' => 'user'], [
            'name' => 'user',
            'guard_name' => 'userapi',
        ]);

        // give permissions to role
        $user_role->givePermissionTo($userPermissions);

        // give role to user
        /* in signup of user */
    }
}
