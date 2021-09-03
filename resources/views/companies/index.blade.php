<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-building mr-2"></i>Empresas / Clientes</h1>
        </div>
        @can('create companies')
        <div class="col-sm-6">
            <div class="float-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createCompanyModal">
                    <i class="fa fa-pencil-alt mr-2" aria-hidden="true"></i>Nuevo
                </button>
                <a href="{{ route('companies.export') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-download mr-2"></i>XLS</a>
            </div>
        </div>
        @endcan
    </x-slot>

    @if (session()->has('message'))
    <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif

    @livewire('companies.show-companies-table')

    <!-- createCompnayModal -->
    @can('create companies')
    <div class="modal fade" id="createCompanyModal" tabindex="-1" role="dialog" aria-labelledby="createCompanyModal"
        aria-hidden="true">
        <div class="modal-dialog">
            @include('companies._form')
        </div>
    </div>
    @endcan

    <x-slot name="custom_scripts">
        <script>
            if (window.location.hash === '#create')
            {
                $('#createCompanyModal').modal('show');
            }
            $('#createCompanyModal').on('hide.bs.modal', function (){
                window.location.hash = '#';
            });

            $('#createCompanyModal').on('shown.bs.modal', function (){
                $('input[name="name"]').focus();
                window.location.hash = '#create';
            });
        </script>
    </x-slot>
</x-main-layout>
