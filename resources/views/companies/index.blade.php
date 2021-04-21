<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1>Empresas / Clientes</h1>
        </div>
        @can('create companies')
            <div class="col-sm-6">
                <div class="btn-group float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#createCompnayModal">
                        <i class="fa fa-pencil-alt mr-2" aria-hidden="true"></i>Nuevo
                    </button>
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon"
                        data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        {{-- <a class="dropdown-item" href="#"><i class="fas fa-upload mr-2"></i>Importar</a> --}}
                        <a class="dropdown-item" href="{{ route('companies.export') }}"><i
                                class="fas fa-download mr-2"></i>Exportar</a>
                    </div>
                </div>
            </div>
        @endcan
    </x-slot>

    @livewire('companies.show-companies-table')

    <!-- createCompnayModal -->
    @can('create companies')
        <div class="modal fade" id="createCompnayModal" tabindex="-1" role="dialog" aria-labelledby="createCompnayModal"
            aria-hidden="true">
            <div class="modal-dialog">
                @livewire('companies.create-company-form')
            </div>
        </div>
    @endcan

    <!-- updateCompanyModal -->
    @can('edit companies')
        <div class="modal fade" id="updateCompanyModal" tabindex="-1" role="dialog" aria-labelledby="updateCompanyModal"
            aria-hidden="true">
            <div class="modal-dialog">
                @livewire('companies.update-company-form')
            </div>
        </div>
    @endcan

    <x-slot name="custom_scripts">
        <script>
            window.livewire.on('companyAddedOrUpdated', () => {
                $('#createCompnayModal').modal('hide');
                $('#updateCompanyModal').modal('hide');
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
                            Livewire.emit('deleteCompany', id);
                            swal("La empresa ha sido eliminada.", {
                                icon: "success",
                            });
                        }
                    });
            }

        </script>
    </x-slot>
</x-main-layout>
