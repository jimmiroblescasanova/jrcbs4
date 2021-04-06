<?php

namespace App\Http\Livewire\Configurations;

use Brotzka\DotenvEditor\DotenvEditor;
use Livewire\Component;

class ChangeHosts extends Component
{

    public $sql_host, $sql_port, $sql_user, $sql_pswd, $sql_bdd_name;

    protected $rules = [
        'sql_host' => ['nullable', 'string', 'min:6'],
        'sql_port' => ['required_with:sql_host', 'numeric'],
        'sql_user' => ['nullable', 'string', 'min:2'],
        'sql_pswd' => ['required_with:sql_user', 'string', 'min:6'],
        'sql_bdd_name' => ['required_with_all:sql_host,sql_port,sql_user,sql_pswd', 'string'],
    ];

    public function save()
    {
        $this->validate();

        $env = new DotenvEditor();
        $env->changeEnv([
            'DB_HOST_SQLSRV'   => $this->sql_host,
            'DB_PORT_SQLSRV'   => $this->sql_port,
            'DB_USERNAME_SQLSRV'   => $this->sql_user,
            'DB_PASSWORD_SQLSRV'   => $this->sql_pswd,
            'DB_DATABASE_SQLSRV'   => $this->sql_bdd_name,
        ]);

        session()->flash('message', 'Datos actualizados correctamente');
    }

    public function mount()
    {
        $env = new DotenvEditor();
        $this->sql_host = $env->getValue("DB_HOST_SQLSRV");
        $this->sql_port = $env->getValue("DB_PORT_SQLSRV");
        $this->sql_user = $env->getValue("DB_USERNAME_SQLSRV");
        $this->sql_pswd = $env->getValue("DB_PASSWORD_SQLSRV");
        $this->sql_bdd_name = $env->getValue("DB_DATABASE_SQLSRV");
    }

    public function render()
    {
        return view('livewire.configurations.change-hosts');
    }
}
