<div>
    @if (session()->has('message'))
        <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif
    <div class="row">
        @wire
        <div class="form-group col-6 col-md-2">
            <x-form-input type="date" name="start_date" label="Fecha inicial" />
        </div>
        <div class="form-group col-6 col-md-2">
            <x-form-input type="date" name="end_date" label="Fecha final" />
        </div>
        <div class="form-group col-6 col-md-2">
            <x-form-select label="Asignado a" class="border-0 shadow-sm" name="user">
                <option value="">Todos</option>
                @foreach ($users_array as $id => $user)
                    <option value="{{ $id }}">{{ $user }}</option>
                @endforeach
            </x-form-select>
        </div>
        <div class="form-group col-6 col-md-2">
            <x-form-select label="Etiquetas" class="border-0 shadow-sm" name="tag">
                <option value="">Todos</option>
                @foreach ($tags_array as $id => $tag)
                    <option value="{{ $id }}">{{ $tag }}</option>
                @endforeach
            </x-form-select>
        </div>
        <div class="form-group col-6 col-md-2">
            <x-form-select label="Estado" class="border-0 shadow-sm" name="active">
                <option value="1">Activos</option>
                <option value="0">Cerrados</option>
            </x-form-select>
        </div>
        <div class="form-group col-4 col-md-1">
            <x-form-select label="Ver" class="border-0 shadow-sm" name="perPage">
                <option>10</option>
                <option>15</option>
                <option>25</option>
                <option>50</option>
            </x-form-select>
        </div>
        @endwire
        <div class="form-group col-2 col-md-1 m-auto">
            <button wire:click="resetFilters" class="btn btn-danger btn-block border-0 shadow-sm"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0 table-responsive-sm">
            <table class="table table-striped table-inverse">
                <thead>
                    <tr>
                        <x-tables.table-heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Fecha</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('contact')" :direction="$sortField === 'contact_id' ? $sortDirection : null">Contacto</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('activity')" :direction="$sortField === 'activity_id' ? $sortDirection : null">Actividad</x-tables.table-heading>
                        <x-tables.table-heading sortable wire:click="sortBy('user')" :direction="$sortField === 'user' ? $sortDirection : null">Asignado a</x-tables.table-heading>
                        <th>Etiqueta</th>
                        <th style="width: 10%;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                            <td>{{ $ticket->contact->name }}</td>
                            <td>{{ $ticket->activity->name }}</td>
                            <td>{{ $ticket->assignedTo->name }}</td>
                            <td>{!! tag_label($ticket->tag) !!}</td>
                            <td class="text-center">
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-default btn-xs"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $tickets->links() }}
        </div>
        <!-- /.card-footer-->
    </div>
</div>
