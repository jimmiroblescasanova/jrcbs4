<div>
    @if (session()->has('message'))
        <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif
    <div class="row">
        <div class="form-group col-12 col-md 8">
            <input type="text"
                wire:model.debounce.500ms='searchQuery'
                class="form-control border-0 shadow-sm"
                placeholder="Buscar por nombre, RFC"
            />
        </div>
        <div class="form-group col-12 col-md-2">
            <select class="form-control" wire:model='orderByDesc'>
                <option value="1">Descendente</option>
                <option value="0">Ascendente</option>
            </select>
        </div>
        <div class="form-group col-12 col-md-2">
            <select class="form-control" wire:model='perPage'>
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
                        <th>ID</th>
                        <th>Nombre de la empresa</th>
                        <th>RFC</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <td scope="row">{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->rfc }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No existen registros.</td>
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
