<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProgramMailingPermissions extends Seeder
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

        // PROGRAMS
        Permission::create(['name' => 'show programs']);
        Permission::create(['name' => 'create programs']);
        Permission::create(['name' => 'edit programs']);

        // MAILING
        Permission::create(['name' => 'show mailings']);
        Permission::create(['name' => 'create mailings']);

        $role = Role::findByName('administrador');

        $role->syncPermissions(Permission::all());
    }
}
