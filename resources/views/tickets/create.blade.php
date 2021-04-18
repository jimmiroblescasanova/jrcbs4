<x-main-layout>
    <x-slot name="header">
        <h1>Inicio</h1>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Titulo del card</h3>
        </div>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12 col-md-8">
                        <x-form-select name="contact_id" class="select2" label="Seleccionar un contacto">
                            <option></option>
                            @foreach ($contacts as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <x-forms.select :options="$activities" select2="select2" name="activity_id">Actividad</x-forms.select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-8">
                        <x-form-textarea label="Notas" name="note" rows="5" placeholder="Agrega unas notas..." />
                        <small class="text-muted">Máximo 255 carácteres.</small>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="form-group">
                            <x-forms.select :options="$tags" select2="select2" name="tag_id">Etiqueta</x-forms.select>
                        </div>
                        <div class="form-group">
                            <x-form-select name="assigned_to" class="select2" label="Asignar a">
                                <option></option>
                                @foreach ($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user }}</option>
                                @endforeach
                            </x-form-select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                <button type="button" class="btn btn-default btn-sm float-right"
                    onclick="history.back();">Atras</button>
            </div>
            <!-- /.card-footer-->
        </form>
    </div>

    <x-slot name="custom_scripts">
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Selecciona una opción",
                    allowClear: true
                });
            });

        </script>
    </x-slot>
</x-main-layout>
