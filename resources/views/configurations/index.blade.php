<x-main-layout>
    <x-slot name="header">
        <h1>Configuraciones del sistema</h1>
    </x-slot>

    @if (session()->has('edit-role'))
        <x-partials.alert type="danger" :message="session('edit-role')" icon="fas fa-ban" />
    @endif

    <div class="row">
        @can('show activities')
            <div class="col-md-6">
                {{-- @livewire('configurations.activities') --}}
            </div>
        @endcan
        @can('show tags')
            <div class="col-md-6">
                @livewire('configurations.tags')
            </div>
        @endcan
    </div>

    <div class="row">
        @can('show groups')
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-lock mr-2"></i>Grupos
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    @can('edit groups') <th style="width: 15%;">Accion</th> @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role }}</td>
                                        @can('edit groups')
                                            <td>
                                                <a href="{{ route('groups.edit', $role) }}"><i class="fas fa-eye"></i></a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @can('create groups')
                        <div class="card-footer">
                            <a href="{{ route('groups.create') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
                        </div>
                    @endcan
                </div>
            </div>
        @endcan
        <div class="col-6"></div>
    </div>

    @can('edit hosts')
        @livewire('configurations.change-hosts')
    @endcan

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
