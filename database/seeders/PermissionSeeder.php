<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'show companies']);
        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'edit companies']);

        Permission::create(['name' => 'show contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'edit contacts']);

        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);

        Permission::create(['name' => 'show activities']);
        Permission::create(['name' => 'create activities']);
        Permission::create(['name' => 'edit activities']);

        Permission::create(['name' => 'show tags']);
        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'edit tags']);

        Permission::create(['name' => 'show groups']);
        Permission::create(['name' => 'create groups']);
        Permission::create(['name' => 'edit groups']);

        Permission::create(['name' => 'show tickets']);
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'edit tickets']);

        Permission::create(['name' => 'edit hosts']);

        // create administrator role
        $role = Role::create(['name' => 'administrador']);
        $role->givePermissionTo(Permission::all());

        // assign role to user
        User::findOrFail(1)->assignRole('administrador');
    }
}
