@extends('layouts.configurations')

@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fas fa-user-lock mr-2"></i>Grupos
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        @can('edit groups') <th style="width: 15%;">Acción</th> @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        @if($role->id != 1)
                            <tr>
                                <td>{{ $role->name }}</td>
                                @can('edit groups')
                                    <td class="text-center">
                                        <a href="{{ route('configurations.groups.edit', $role->name) }}"><i class="fas fa-edit mr-2"></i></a>
                                        <a onclick="return confirm('Estas seguro de eliminar?');" href="{{ route('configurations.groups.delete', $role->name) }}">
                                            <i style="color:red;cursor: pointer;" class="fas fa-trash-alt"></i></a>
                                    </td>
                                @endcan
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @can('create groups')
            <div class="card-footer">
                <a href="{{ route('configurations.groups.create') }}" class="btn btn-primary btn-sm float-right"><i
                        class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
            </div>
        @endcan
    </div>
@stop
