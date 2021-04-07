<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar datos de empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form wire:submit.prevent="update">
        <input type="hidden" wire:model.lazy="idCompany">
        <div class="modal-body">
            <div class="form-group">
                <x-forms.input wire:model.lazy="name" name="update.name">Nombre de la empresa</x-forms.input>
            </div>
            <div class="form-group">
                <x-forms.input wire:model.lazy="rfc" name="update.rfc">RFC de la empresa</x-forms.input>
            </div>
            <div class="row">
                <p><strong>Contactos de la empresa: </strong></p>
                <ul class="list-group col-12">
                @foreach ($contacts as $contact)
                    <li class="list-group-item">{{ $contact->name }}</li>
                @endforeach
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
        </div>
    </form>
</div>
