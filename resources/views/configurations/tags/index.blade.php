@extends('layouts.configurations')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-tags mr-2"></i>Tabla de etiquetas</h3>
            <div class="card-tools">
                {{ $tags->links('vendor.pagination.bootstrap-4-sm') }}
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="text-center">Color</th>
                    @can('edit tags') <th style="width: 15%;">Acción</th> @endcan
                </tr>
                </thead>
                <tbody>
                    @forelse($tags as $row => $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td class="text-center"><i class="fas fa-circle" style="color: {{ $tag->color }}"></i>
                            <td class="text-center">
                                <a href="#" onclick="editTag('{{ $tag->id }}', '{{ $tag->name }}', '{{ $tag->color }}')" class="mr-2"><i class="fas fa-edit"></i></a>
                                <a href="#" onclick="deleteTag('{{ $tag->id }}', '{{ $row+1 }}')"><i class="fas fa-trash-alt" style="color:red;"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">Listado vacío</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @can('create tags')
            <div class="card-footer clearfix">
                <button data-toggle="modal" data-target="#createTagsModal" type="button" class="btn btn-primary btn-sm float-right"><i
                        class="fas fa-pencil-alt mr-2"></i>Nuevo</button>
            </div>
        @endcan
    </div>
    @can('create tags')
        <div class="modal fade" id="createTagsModal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar etiqueta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('configurations.tags.store') }}" method="POST" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <x-forms.input name="name">Nombre de la etiqueta</x-forms.input>
                            </div>
                            <div class="form-group">
                                <x-forms.input type="color" name="color">Color</x-forms.input>
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
    @can('edit tags')
        <div class="modal fade" id="editTagsModal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar etiqueta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('configurations.tags.update') }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-tag-id" value="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-tag-name">Nuevo nombre</label>
                                <input type="text" class="form-control" name="name" id="edit-tag-name" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit-tag-color">Nuevo color</label>
                                <input type="color" class="form-control" name="color" id="edit-tag-color" value="">
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
        function deleteTag(id, row) {
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
                        url:'{{ route('configurations.tags.delete') }}',
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
                                text: 'No se puede eliminar si tiene registros asociadas',
                            });
                        }
                    });
                }
            });
        }

        function editTag(id, name, color)
        {
            $('#editTagsModal').modal('show');
            $('#edit-tag-id').val(id);
            $('#edit-tag-name').val(name);
            $('#edit-tag-color').val(color);
        }
    </script>
@stop
