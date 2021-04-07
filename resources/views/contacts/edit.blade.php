<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1>Editar un contacto</h1>
        </div>
    </x-slot>

    <div class="card">
        <form action="{{ route('contacts.update', $contact) }}" method="POST" autocomplete="off">
            @csrf
            @method('PATCH')
            @include('contacts._form')
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar contacto</button>
                <button type="button" class="btn btn-default btn-sm float-right" onclick="history.back();">Atrás</button>
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
