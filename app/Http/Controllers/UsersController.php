<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'groups' => Role::all()->pluck('name')
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->group);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'groups' => Role::all()->pluck('name'),
            'user' => $user,
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {

        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update($request->except(['password']));
        }

        $user->syncRoles([$request->group]);

        return redirect()->route('users.index');
    }
}
