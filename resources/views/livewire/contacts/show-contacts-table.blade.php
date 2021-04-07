<div>
    @if (session()->has('message'))
        <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif
    <div class="row">
        <div class="form-group col-12 col-md-10">
            <input type="text"
                wire:model.debounce.500ms='search'
                class="form-control border-0 shadow-sm"
                placeholder="Buscar por nombre, apellidos, email"
            />
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
            <table class="table table-striped table-inverse">
                <thead>
                    <tr>
                        <x-tables.table-heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">ID</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">Nombre del contacto</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('lastname')" :direction="$sortField === 'lastname' ? $sortDirection : null">Apellidos</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('email')" :direction="$sortField === 'email' ? $sortDirection : null">Email</x-tables.table-heading>
                        <th>Teléfono</th>
                        <th style="width: 10%;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td scope="row">{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->lastname }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td class="text-center">
                                <a href="{{ route('contacts.edit', $contact) }}" type="button"
                                    class="btn btn-xs btn-default mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDeletion({{ $contact->id }}, '{{ $contact->name }}')" class="btn btn-xs btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No existen registros asociados a la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $contacts->links() }}
        </div>
        <!-- /.card-footer-->
    </div>
</div>
