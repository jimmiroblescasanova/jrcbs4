@extends('layouts.configurations')

@section('content')
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title"><i class="fas fa-hdd mr-2"></i>Programas</h3>
        <div class="card-tools">
            {{ $programs->links('vendor.pagination.bootstrap-4-sm') }}
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    @can('edit programs')<th style="width: 15%;">Acción</th>@endcan
                </tr>
            </thead>
            <tbody>
                @forelse($programs as $row => $program)
                <tr>
                    <td>{{ $program->name }}</td>
                    <td>{{ isProgramAnnual($program->annual_license) }}</td>
                    @can('edit programs')
                    <td class="text-center">
                        <a href="{{ route('configurations.programs.edit', $program) }}" class="edit mr-2"><i
                                class="fas fa-edit"></i></a>
                        <a href="#" onclick="deleteProgram('{{ $program->id }}', '{{ $row+1 }}')"><i
                                class="fas fa-trash-alt" style="color:red;"></i></a>
                    </td>
                    @endcan
                </tr>
                @empty
                <tr>
                    <td colspan="3">No existe ningún registro</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @can('create programs')
    <div class="card-footer clearfix">
        <a href="{{ route('configurations.programs.create') }}" class="btn btn-primary btn-sm float-right"><i
                class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
    </div>
    @endcan
</div>
@stop

@section('myScripts')
<script>
    function deleteProgram(id, row) {
            Swal.fire({
                icon: 'warning',
                text: '¿Estas seguro de querer eliminar la fila #'+row+'?',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                        url:'{{ route('configurations.programs.delete') }}',
                        data:{'_method':'delete', 'id':id},
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
