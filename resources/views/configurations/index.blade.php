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

            window.livewire.on('alert-error', event => {
                swal({
                    icon: "error",
                    title: event.title,
                    text: event.message,
                });
            });

            function deleteRow(id, name, modelName) {
                swal({
                title: "Confirmación",
                text: "Estas a punto de eliminar el registro: " + name + ", ¿Continuar?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        Livewire.emit(modelName, id);
                    }
                });
            }
        </script>
    </x-slot>
</x-main-layout>
