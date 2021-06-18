<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('configurations.groups.index', [
            'roles' => Role::all(),
        ]);
    }

    public function create()
    {
        $role = new Role();

        return view('configurations.groups.create', [
            'role' => $role,
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->group_name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('configurations.groups.index');
    }

    public function edit($name)
    {
        $role = Role::findByName($name);

        if ($role->name == 'administrador') {
            session()->flash('edit-role', 'No se puede editar el usuario administrador');
            return redirect()->back();
        }

        return view('configurations.groups.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'group_name' => ['required', 'string', 'min:5'],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->group_name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('configurations.groups.index');
    }

    public function destroy($role)
    {
//        $role_to_delete = Role::findByName($role);

        $users = User::role($role)->get();

        if (count($users)>0)
        {
            session()->flash('cant-delete', 'El perfil tiene modelos asociados, no se puede eliminar.');
            return redirect()->back();
        } else {
            Role::findByName($role)->delete();
            return redirect()->back();
        }

    }
}
