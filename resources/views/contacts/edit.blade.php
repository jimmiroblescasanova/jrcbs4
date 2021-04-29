<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-edit mr-2"></i>Editar un contacto</h1>
        </div>
    </x-slot>

    <div class="card">
        <form action="{{ route('contacts.update', $contact) }}" method="POST" autocomplete="off">
            @csrf
            @method('PATCH')
            @include('contacts._form')
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i>Actualizar contacto</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="history.back();"><i class="fas fa-ban mr-2"></i>Cancelar</button>
                </div>
            </div>
        </form>
    </div>

    <x-slot name="custom_scripts">
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Selecciona o deja en blanco",
                    allowClear: true
                });
            });
        </script>
    </x-slot>
</x-main-layout>
