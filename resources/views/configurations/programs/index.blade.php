@extends('layouts.configurations')

@section('content')
    <div class="card">
        <div class="card-header">
            Configuraciones
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @forelse($programs as $row => $program)
                    <tr>
                        <td>{{ $program->name }}</td>
                        <td>{{ isProgramAnnual($program->annual_license) }}</td>
                        <td>
                            <a href="{{ route('configurations.programs.edit', $program) }}" class="edit mr-2"><i class="fas fa-edit"></i></a>
                            <a href="#" onclick="deleteProgram('{{ $program->id }}', '{{ $row+1 }}')"><i class="fas fa-trash-alt" style="color:red;"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No existe ningún registro</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
{{--        @can('create programs')--}}
            <div class="card-footer clearfix">
                <a href="{{ route('configurations.programs.create') }}" type="button" class="btn btn-primary btn-sm float-right"><i class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
            </div>
{{--        @endcan--}}
    </div>
@stop

@section('myScripts')
    <script>
        function deleteProgram(id, row) {
            if (confirm('Deseas eliminar el registro')){
                $.ajax({
                    headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                    url:'{{ route('configurations.programs.destroy') }}',
                    data:{'_method':'delete', 'id':id},
                    type:'post',
                    success: function (data) {
                        console.log(data.response);
                        if (data.response)
                        {
                            $('tr').eq(row).hide('slow', function(){ $('tr').eq(row).remove(); });
                        }
                    }
                });
            }
        }
    </script>
@stop
