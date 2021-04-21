<div>
    @if (session()->has('message'))
        <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif
    <div class="row">
        <div class="form-group col-12 col-md-10">
            <input type="text" wire:model.debounce.500ms='search' class="form-control border-0 shadow-sm"
                placeholder="Buscar por nombre, RFC" />
        </div>
        <div class="form-group col-12 col-md-2">
            <select class="form-control border-0 shadow-sm" wire:model='perPage'>
                <option>10</option>
                <option>15</option>
                <option>25</option>
                <option>50</option>
            </select>
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
                        @can('edit companies')
                            <th style="width: 10%;">Opciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <td scope="row">{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->rfc }}</td>
                            @can('edit companies')
                                <td class="text-center">
                                    <a wire:click="$emit('editModal', {{ $company->id }})"
                                        class="btn btn-default btn-xs mr-2" data-toggle="modal"
                                        data-target="#updateCompanyModal" class="mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a onclick="confirmDeletion({{ $company->id }}, '{{ $company->name }}');"
                                        class="btn btn-danger btn-xs">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No existen registros.</td>
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
