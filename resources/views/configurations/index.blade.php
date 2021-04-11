<x-main-layout>
    <x-slot name="header">
        <h1>Configuraciones del sistema</h1>
    </x-slot>

    <div class="row">
        <div class="col-md-6">
            @livewire('configurations.activities')
        </div>
        <div class="col-md-6">
            @livewire('configurations.tags')
        </div>
    </div>

    @livewire('configurations.change-hosts')

    <x-slot name="custom_scripts">
        <script>
            window.livewire.on('hideModalTrigger', () => {
                $('.modal').modal('hide');
            });

            window.livewire.on('addTagModal', () => {
                $('#modal-tags').modal('show');
            });

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
                        Livewire.emit('delete', id);
                        swal("La empresa ha sido eliminada.", {
                            icon: "success",
                        });
                    }
                });
            }
        </script>
    </x-slot>
</x-main-layout>
