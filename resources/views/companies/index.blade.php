<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-building mr-2"></i>Empresas / Clientes</h1>
        </div>
        @can('create companies')
            <div class="col-sm-6">
                <div class="btn-group float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#createCompanyModal">
                        <i class="fa fa-pencil-alt mr-2" aria-hidden="true"></i>Nuevo
                    </button>
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon"
                        data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        {{-- <a class="dropdown-item" href="#"><i class="fas fa-upload mr-2"></i>Importar</a> --}}
                        <a class="dropdown-item" href="{{ route('companies.export') }}"><i
                                class="fas fa-download mr-2"></i>Exportar listado</a>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" data-target="#reportCompaniesModal"><i
                                class="fas fa-print mr-2"></i>Empresas y contactos</button>
                    </div>
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

    <div class="modal fade" id="reportCompaniesModal" tabindex="-1" role="dialog" aria-labelledby="reportCompaniesModal"
         aria-hidden="true">
        <div class="modal-dialog">
            @include('companies._parameters-report')
        </div>
    </div>

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
