<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form wire:submit.prevent="save">
        <div class="modal-body">
            <div class="form-group">
                <x-forms.input wire:model.lazy="name" name="save.name">Nombre de la empresa</x-forms.input>
            </div>
            <div class="form-group">
                <x-forms.input wire:model.lazy="rfc" name="save.rfc">RFC de la empresa</x-forms.input>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
        </div>
    </form>
</div>