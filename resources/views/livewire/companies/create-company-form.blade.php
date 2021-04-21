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
                <x-forms.input label="Nombre de la empresa" wire:model.lazy="name" name="name" />
            </div>
            <div class="form-group">
                <x-forms.input label="RFC de la empresa" wire:model.lazy="rfc" name="rfc" />
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
        </div>
    </form>
</div>
