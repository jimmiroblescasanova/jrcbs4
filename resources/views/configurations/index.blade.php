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

            window.livewire.on('addOrUpdateModal', () => {
                $('#activitiesModal').modal('show');
            });

            function deleteTag(id, name) {
                swal({
                title: "Confirmar",
                text: "Se eliminará: " + name + ", no se podrá recuperar finalizado el proceso.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        Livewire.emit('deleteTag', id);
                        swal("La empresa ha sido eliminada.", {
                            icon: "success",
                        });
                    }
                });
            }

            function deleteActivity(id, name) {
                swal({
                title: "Confirmar",
                text: "Se eliminará: " + name + ", no se podrá recuperar finalizado el proceso.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        Livewire.emit('deleteActivity', id);
                        swal("La empresa ha sido eliminada.", {
                            icon: "success",
                        });
                    }
                });
            }
        </script>
    </x-slot>
</x-main-layout>
