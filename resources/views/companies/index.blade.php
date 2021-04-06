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

    <!-- Modal -->
    <div class="modal fade" id="createCompnayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            @livewire('companies.create-company-form')
        </div>
    </div>

    <x-slot name="custom_scripts">
        <script>
            window.livewire.on('companyAdded', () => {
                $('#createCompnayModal').modal('hide');
            });
        </script>
    </x-slot>
</x-main-layout>
