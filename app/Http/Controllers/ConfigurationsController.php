<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brotzka\DotenvEditor\DotenvEditor;

class ConfigurationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $env = new DotenvEditor();

        $data = [
            'sql_host' => $env->getValue("DB_HOST_SQLSRV"),
            'sql_port' => $env->getValue("DB_PORT_SQLSRV"),
            'sql_user' => $env->getValue("DB_USERNAME_SQLSRV"),
            'sql_pswd' => $env->getValue("DB_PASSWORD_SQLSRV"),
            'sql_bdd_name' => $env->getValue("DB_DATABASE_SQLSRV"),
        ];

        return view('configurations.index', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sql_host' => ['nullable', 'string', 'min:6'],
            'sql_port' => ['required_with:sql_host', 'numeric'],
            'sql_user' => ['nullable', 'string', 'min:2'],
            'sql_pswd' => ['required_with:sql_user', 'string', 'min:6'],
            'sql_bdd_name' => ['required_with_all:sql_host,sql_port,sql_user,sql_pswd', 'string'],
        ]);

        $env = new DotenvEditor();
        $env->changeEnv([
            'DB_HOST_SQLSRV'   => $request->sql_host,
            'DB_PORT_SQLSRV'   => $request->sql_port,
            'DB_USERNAME_SQLSRV'   => $request->sql_user,
            'DB_PASSWORD_SQLSRV'   => $request->sql_pswd,
            'DB_DATABASE_SQLSRV'   => $request->sql_bdd_name,
        ]);

        return redirect()->back()->with('message', 'Datos actualizados correctamente');
    }
}
