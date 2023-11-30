<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{

    public function run()
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'residences_access',
            'residences_edit',
            'residences_delete',
            'residences_show',
            'listings_access',
            'listings_edit',
            'listings_delete',
            'listings_show',
            'comments_access',
            'comments_edit',
            'comments_delete',
            'comments_show',
            'users_access',
            'users_show',
            'users_delete'
        ];


        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $userRole = Role::create(['name' => 'User']);
        $adminRole = Role::create(['name' => 'Admin']);

        foreach ($permissions as $permission) {
            $adminRole->givePermissionTo($permission);
            if ($permission != 'users_access' && $permission != 'users_show' && $permission != 'users_delete') {
                $userRole->givePermissionTo($permission);
            }
        }

    }
}
