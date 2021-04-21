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

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th style="width: 15%;">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $id => $role)
                                <tr>
                                    <td>{{ $role }}</td>
                                    <td>
                                        <a href="{{ route('groups.edit', $id) }}"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('groups.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
                </div>
            </div>
        </div>
        <div class="col-6"></div>
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
