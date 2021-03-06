<div>
    <div class="row">
        <div class="form-group col-12 col-md-8">
            <input type="text" wire:model.debounce.500ms='search' class="form-control border-0 shadow-sm"
                placeholder="Buscar por Nombre, RFC, Nombre comercial" />
        </div>
        <div class="form-group col-12 col-md-2">
            <select class="form-control border-0 shadow-sm" wire:model='perPage'>
                <option>10</option>
                <option>15</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" wire:model='showInactive' id="customSwitch1"
                    value="1">
                <label class="custom-control-label" for="customSwitch1">Ver inactivos</label>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <x-tables.table-heading sortable wire:click="sortBy('id')"
                            :direction="$sortField === 'id' ? $sortDirection : null">ID</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('name')"
                            :direction="$sortField === 'name' ? $sortDirection : null">Nombre de la empresa
                        </x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('rfc')"
                            :direction="$sortField === 'rfc' ? $sortDirection : null">R.F.C.</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('tradeName')"
                            :direction="$sortField === 'tradeName' ? $sortDirection : null">Nombre comercial
                        </x-tables.table-heading>
                        @can('edit companies')
                        <th style="width: 10%;">&nbsp;</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->rfc }}</td>
                        <td>{{ $company->tradeName }}</td>
                        @can('edit companies')
                        <td class="text-center">
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-default btn-xs mr-2">
                                <i class="fas fa-edit mr-2"></i>Editar
                            </a>
                        </td>
                        @endcan
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No existen registros.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $companies->links() }}
        </div>
        <!-- /.card-footer-->
    </div>
</div>
