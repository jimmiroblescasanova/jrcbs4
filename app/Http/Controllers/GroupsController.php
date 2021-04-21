<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GroupsController extends Controller
{
    public function create()
    {
        $role = new Role();

        return view('groups.create', [
            'role' => $role,
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->group_name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('configurations.index');
    }

    public function edit($id)
    {
        $role = Role::findById($id);

        return view('groups.edit', [
            'role' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'group_name' => ['required', 'string', 'min:5'],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->group_name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('configurations.index');
    }
}
