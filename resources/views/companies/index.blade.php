<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1>Empresas / Clientes</h1>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                data-target="#createCompnayModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
        </div>
    </x-slot>


    @livewire('companies.show-companies-table')

    <!-- createCompnayModal -->
    <div class="modal fade" id="createCompnayModal" tabindex="-1" role="dialog" aria-labelledby="createCompnayModal"
        aria-hidden="true">
        <div class="modal-dialog">
            @livewire('companies.create-company-form')
        </div>
    </div>

    <!-- updateCompanyModal -->
    <div class="modal fade" id="updateCompanyModal" tabindex="-1" role="dialog" aria-labelledby="updateCompanyModal"
        aria-hidden="true">
        <div class="modal-dialog">
            @livewire('companies.update-company-form')
        </div>
    </div>

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
