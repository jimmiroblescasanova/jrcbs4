@extends('layouts.configurations')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Tabla de actividades</h3>
            <div class="card-tools">
                {{ $activities->links('vendor.pagination.bootstrap-4-sm') }}
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        @can('edit activities') <th style="width: 15%;">Acción</th> @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $row => $activity)
                        <tr>
                            <td scope="row">{{ $activity->name }}</td>
                            @can('edit activities')
                                <td class="text-center">
                                    <a href="#" onclick="editActivity('{{ $activity->id }}', '{{ $activity->name }}');" class="edit mr-2"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="deleteActivity('{{ $activity->id }}', '{{ $row+1 }}');"><i class="fas fa-trash-alt" style="color:red;"></i></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @can('create activities')
            <div class="card-footer clearfix">
                <button data-toggle="modal" data-target="#activitiesModal" type="button" class="btn btn-primary btn-sm float-right"><i
                        class="fas fa-pencil-alt mr-2"></i>Nuevo</button>
            </div>
        @endcan
    </div>
    @can('create activities')
        <div class="modal fade" id="activitiesModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar actividad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('configurations.activities.store') }}" role="form" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <x-forms.input name="name">Nombre de la actividad</x-forms.input>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endcan

    @can('edit activities')
        <div class="modal fade" id="editActivitiesModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar actividad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('configurations.activities.update') }}" role="form" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="edit-activity-id" value="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-activity-name">Nuevo nombre</label>
                                <input type="text" class="form-control" name="name" id="edit-activity-name" value="">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endcan
@stop

@section('myScripts')
    <script>
        $(document).ready(function() {
            if(window.location.href.indexOf('#activitiesModal') !== -1) {
                $('#activitiesModal').modal('show');
            }
        });

        function deleteActivity(id, row){
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
                        url:'{{ route('configurations.activities.delete') }}',
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
