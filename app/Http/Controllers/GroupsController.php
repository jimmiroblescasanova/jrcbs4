<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function edit($name)
    {
        $role = Role::findByName($name);

        if ($role->name == 'administrador') {
            session()->flash('edit-role', 'No se puede editar el usuario administrador');
            return redirect()->back();
        }

        return view('groups.edit', compact('role'));
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
