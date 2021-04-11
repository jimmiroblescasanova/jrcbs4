<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabla de etiquetas</h3>
            <button type="button" wire:click="addTag" class="btn btn-primary btn-xs float-right">Nuevo</button>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th style="width: 15%;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td scope="row">{{ $tag->name }}</td>
                            <td><i class="fas fa-circle" style="color: {{ $tag->color }}"></i></td>
                            <td class="text-center">
                                <a href="#" wire:click="updateTag({{ $tag->id }})"><i class="fas fa-edit mr-2"></i></a>
                                <a href="#" onclick="confirmDeletion({{ $tag->id }}, '{{ $tag->name }}')"><i class="fas fa-trash-alt" style="color: red;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0">
            {{ $tags->links() }}
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal-tags" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar etiqueta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" wire:submit.prevent='save'>
                    <input type="hidden" wire:model.lazy="idTag">
                    <div class="modal-body">
                        <div class="form-group">
                            <x-forms.input name="name" wire:model.lazy="name">Nombre de la etiqueta</x-forms.input>
                        </div>
                        <div class="form-group">
                            <x-forms.input type="color" name="color" wire:model.lazy="color">Color</x-forms.input>
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
</div>