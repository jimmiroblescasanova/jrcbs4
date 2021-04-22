<div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Tabla de actividades</h3>
            <div class="card-tools">
                {{ $activities->links() }}
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        @can('edit activities') <th style="width: 15%;">Acción</th> @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td scope="row">{{ $activity->name }}</td>
                            @can('edit activities')
                                <td class="text-center">
                                    <a wire:click="updateActivity({{ $activity }})" href="#" class="mr-2"><i
                                            class="fas fa-edit"></i></a>
                                    <a onclick="deleteRow({{ $activity->id }}, '{{ $activity->name }}', 'deleteActivity')"
                                        href="#"><i class="fas fa-trash-alt" style="color:red;"></i></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @can('create activities')
            <div class="card-footer clearfix">
                <button wire:click="addActivity" type="button" class="btn btn-primary btn-sm float-right"><i
                        class="fas fa-pencil-alt mr-2"></i>Nuevo</button>
            </div>
        @endcan
    </div>
    @canany(['create activities', 'edit activities'])
        <div wire:ignore.self class="modal fade" id="activitiesModal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar actividad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form role="form" wire:submit.prevent='saveActivity'>
                        <input type="hidden" wire:model.lazy="activityId">
                        <div class="modal-body">
                            <div class="form-group">
                                <x-forms.input name="name" wire:model.lazy="name">Nombre de la actividad</x-forms.input>
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
    @endcanany
</div>
