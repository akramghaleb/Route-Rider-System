<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = array();

        // Misc
        $permissions[] = Permission::create(['name' => 'N/A']);


        // bus
        $permissions[] = Permission::create(['name' => 'view_bus']);
        $permissions[] = Permission::create(['name' => 'view_any_bus']);
        $permissions[] = Permission::create(['name' => 'create_bus']);
        $permissions[] = Permission::create(['name' => 'update_bus']);
        $permissions[] = Permission::create(['name' => 'restore_bus']);
        $permissions[] = Permission::create(['name' => 'restore_any_bus']);
        $permissions[] = Permission::create(['name' => 'delete_bus']);
        $permissions[] = Permission::create(['name' => 'delete_any_bus']);
        $permissions[] = Permission::create(['name' => 'force_delete_bus']);
        $permissions[] = Permission::create(['name' => 'force_delete_any_bus']);

        // customer
        $permissions[] = Permission::create(['name' => 'view_customer']);
        $permissions[] = Permission::create(['name' => 'view_any_customer']);
        $permissions[] = Permission::create(['name' => 'create_customer']);
        $permissions[] = Permission::create(['name' => 'update_customer']);
        $permissions[] = Permission::create(['name' => 'restore_customer']);
        $permissions[] = Permission::create(['name' => 'restore_any_customer']);
        $permissions[] = Permission::create(['name' => 'delete_customer']);
        $permissions[] = Permission::create(['name' => 'delete_any_customer']);
        $permissions[] = Permission::create(['name' => 'force_delete_customer']);
        $permissions[] = Permission::create(['name' => 'force_delete_any_customer']);

        // transportation
        $permissions[] = Permission::create(['name' => 'view_transportation']);
        $permissions[] = Permission::create(['name' => 'view_any_transportation']);
        $permissions[] = Permission::create(['name' => 'create_transportation']);
        $permissions[] = Permission::create(['name' => 'update_transportation']);
        $permissions[] = Permission::create(['name' => 'restore_transportation']);
        $permissions[] = Permission::create(['name' => 'restore_any_transportation']);
        $permissions[] = Permission::create(['name' => 'delete_transportation']);
        $permissions[] = Permission::create(['name' => 'delete_any_transportation']);
        $permissions[] = Permission::create(['name' => 'force_delete_transportation']);
        $permissions[] = Permission::create(['name' => 'force_delete_any_transportation']);

        // Theme permissions
        $permissions[] = Permission::create(['name' => 'page_Themes']);

        $userRole = Role::create(['name' => 'cashier'])
            ->syncPermissions($permissions);

        $permissions[] = Permission::create(['name' => 'view_all_customer']);
        $permissions[] = Permission::create(['name' => 'view_all_transportation']);

        // Role
        $permissions[] = Permission::create(['name' => 'view_shield::role']);
        $permissions[] = Permission::create(['name' => 'view_any_shield::role']);
        $permissions[] = Permission::create(['name' => 'create_shield::role']);
        $permissions[] = Permission::create(['name' => 'update_shield::role']);
        $permissions[] = Permission::create(['name' => 'delete_shield::role']);
        $permissions[] = Permission::create(['name' => 'delete_any_shield::role']);

        // User
        $permissions[] = Permission::create(['name' => 'view_user']);
        $permissions[] = Permission::create(['name' => 'view_any_user']);
        $permissions[] = Permission::create(['name' => 'create_user']);
        $permissions[] = Permission::create(['name' => 'update_user']);
        $permissions[] = Permission::create(['name' => 'delete_user']);
        $permissions[] = Permission::create(['name' => 'delete_any_user']);
        $permissions[] = Permission::create(['name' => 'update_password_user']);

        $superAdminRole = Role::create(['name' => 'manager'])
            ->syncPermissions($permissions);

        // CREATE ADMINS & USERS
        User::create([
            'name' => 'Akram Ghaleb',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);

        User::create([
            'name' => 'cashier',
            'email' => 'cashier@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($userRole);

        User::create([
            'name' => 'user',
            'email' => 'user@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($userRole);
    }
}
