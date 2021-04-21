<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-users mr-2"></i>Usuarios</h1>
        </div>
        <div class="col-sm-6">
            <div class="btn-group float-right">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                    <a class="dropdown-item" href="#"><i class="fas fa-download mr-2"></i>Exportar excel</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-print mr-2"></i>Imprimir</a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-header">
            Header
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-default btn-xs"><i class="fas fa-eye mr-2"></i>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>

</x-main-layout>
