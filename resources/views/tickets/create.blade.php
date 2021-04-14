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
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <x-forms.select :options="$contacts" select2="select2" name="contact_id">Seleccionar un contacto</x-forms.select>
                    </div>
                    <div class="form-group col-12 col-md-3">
                        <x-forms.select :options="$activities" select2="select2" name="activity_id">Actividad</x-forms.select>
                    </div>
                    <div class="form-group col-12 col-md-3">
                        <x-forms.select :options="$tags" select2="select2" name="tag_id">Etiqueta</x-forms.select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-12">
                        <label for="comments">Comentarios</label>
                        <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                        <small class="text-muted">Máximo 255 carácteres.</small>
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
