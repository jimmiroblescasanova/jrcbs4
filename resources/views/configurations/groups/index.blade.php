@extends('layouts.configurations')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-user-lock mr-2"></i>Grupos</h3>
            <div class="card-tools">
                {{ $roles->links('vendor.pagination.bootstrap-4-sm') }}
            </div>
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
                    @foreach ($roles as $row => $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            @can('edit groups')
                                <td class="text-center">
                                    <a href="{{ route('configurations.groups.edit', $role->name) }}"><i class="fas fa-edit mr-2"></i></a>
                                    <a href="#" onclick="deleteGroup('{{ $role->name }}', '{{ $row+1 }}');">
                                        <i style="color:red;cursor: pointer;" class="fas fa-trash-alt"></i></a>
                                </td>
                            @endcan
                        </tr>
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

@section('myScripts')
    <script>
        function deleteGroup(id, row) {
            Swal.fire({
                icon: 'warning',
                text: '¿Estas seguro de querer eliminar la fila #'+row+'?',
                showCancelButton: true,
                cancelButtonText: 'No, cancelar!',
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                        url:'{{ route('configurations.groups.delete') }}',
                        data:{'_method':'delete', 'name':id},
                        type:'post',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data.response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                            });
                            $('tr').eq(row).hide('slow', function(){ $('tr').eq(row).remove(); });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'No se puede eliminar si tiene registros asociados',
                            });
                        }
                    });
                }
            });
        }
    </script>
@stop
