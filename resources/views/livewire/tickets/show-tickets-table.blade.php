<div>
    @if (session()->has('message'))
        <x-partials.alert icon="fas fa-check" :message="session('message')" />
    @endif
    <div class="row">
        <div class="form-group col-12 col-md-5">
            <label for="">Contactos</label>
            <select class="form-control border-0 shadow-sm">

            </select>
        </div>
        <div class="form-group col-12 col-md-2">
            <label for="">Usuario</label>
            <select class="form-control border-0 shadow-sm">
                <option value="all">Todos</option>
                @foreach ($users as $id => $user)
                    <option value="{{ $id }}">{{ $user }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-2">
            <label for="">Etiquetas</label>
            <select class="form-control border-0 shadow-sm">
                <option value="all">Todos</option>
                @foreach ($tags as $id => $tag)
                    <option value="{{ $id }}">{{ $tag }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-2">
            <label for="">Estado</label>
            <select class="form-control border-0 shadow-sm">
                <option value="all">Todos</option>
                <option value="1">Activos</option>
                <option value="0">Cerrados</option>
            </select>
        </div>
        <div class="form-group col-12 col-md-1">
            <label for="">Ver</label>
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
                        <th>Fecha</th>
                        <th>Contacto</th>
                        <th>Actividad</th>
                        <th>Etiqueta</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                            <td>{{ $ticket->contact->name }}</td>
                            <td>{{ $ticket->activity->name }}</td>
                            <td>{{ $ticket->tag->name }}</td>
                            <td>{{ $ticket->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
</div>
