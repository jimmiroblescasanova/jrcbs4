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
            'roles' => Role::where('id', '>', 1)->orderBy('name')->paginate(5),
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

    public function destroy()
    {
        $role = request()->input('name');

        if (request()->json())
        {
            $users = User::role($role)->get();

            if (count($users)>0)
            {
                return response()->json([
                    'response' => 'Error'
                ], 500);
            }

            Role::findByName($role)->delete();

            return response()->json([
                'response' => 'Eliminado'
            ]);
        }

    }
}
