<div>
    @if (session()->has('message'))
        <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif
    <div class="row">
        @wire
        <div class="form-group col-12 col-md-2">
            <x-form-input type="date" name="start_date" label="Fecha inicial" />
        </div>
        <div class="form-group col-12 col-md-2">
            <x-form-input type="date" name="end_date" label="Fecha final" />
        </div>
        <div class="form-group col-12 col-md-3">
            <x-form-select label="Asignado a" class="border-0 shadow-sm" name="users">
                <option value="all">Todos</option>
                @foreach ($users as $id => $user)
                    <option value="{{ $id }}">{{ $user }}</option>
                @endforeach
            </x-form-select>
        </div>
        <div class="form-group col-12 col-md-2">
            <x-form-select label="Etiquetas" class="border-0 shadow-sm" name="tagFilter">
                <option value="">Todos</option>
                @foreach ($tags as $id => $tag)
                    <option value="{{ $id }}">{{ $tag }}</option>
                @endforeach
            </x-form-select>
        </div>
        <div class="form-group col-12 col-md-2">
            <x-form-select label="Estado" class="border-0 shadow-sm" name="activeFilter">
                <option value="1">Activos</option>
                <option value="0">Cerrados</option>
            </x-form-select>
        </div>
        <div class="form-group col-12 col-md-1">
            <x-form-select label="Ver" class="border-0 shadow-sm" name="perPage">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </x-form-select>
        </div>
        @endwire
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-inverse">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Contacto</th>
                        <th>Actividad</th>
                        <th>Etiqueta</th>
                        <th>Actualizado / Finalizado</th>
                        <th style="width: 10%;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                            <td>{{ $ticket->contact->name }}</td>
                            <td>{{ $ticket->activity->name }}</td>
                            <td>{!! tag_label($ticket->tag) !!}</td>
                            <td>{{ $ticket->active ? $ticket->updated_at->diffForHumans() : $ticket->ended_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('tickets.show', $ticket) }}" class="text-muted"><i class="fas fa-edit"></i></a>
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
