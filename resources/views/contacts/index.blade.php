<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1>Contactos</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
        </div>
    </x-slot>

    @livewire('contacts.show-contacts-table')

    <x-slot name="custom_scripts">
        <script>
            function confirmDeletion(id, name) {
                swal({
                title: "Confirmar",
                text: "Se eliminará: " + name + ", no se podrá recuperar finalizado el proceso.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        Livewire.emit('deleteContact', id);
                        swal("Ok! El contacto ha sido eliminado", {
                            icon: "success",
                        });
                    }
                });
            }
        </script>
    </x-slot>
</x-main-layout>