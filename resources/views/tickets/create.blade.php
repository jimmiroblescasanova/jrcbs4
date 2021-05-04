<x-main-layout>
    <x-slot name="header">
        <h1><i class="far fa-calendar-check mr-2"></i>Agregar nuevo ticket</h1>
    </x-slot>

    <div class="card">
        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12 col-md-8">
                        <x-forms.select name="contact_id" class="select2" label="Seleccionar un contacto">
                            <option></option>
                            @foreach ($contacts as $contact)
                                <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <x-forms.select name="activity_id" class="select2" label="Actividad">
                            <option></option>
                            @foreach ($activities as $id => $activity)
                                <option value="{{ $id }}">{{ $activity }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-8">
                        <x-form-textarea label="Notas" name="note" rows="5" placeholder="Agrega unas notas..." />
                        <small class="text-muted">Máximo 255 carácteres.</small>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="form-group">
                            <x-forms.select name="tag_id" class="select2" label="Seleccionar etiqueta">
                                <option></option>
                                @foreach ($tags as $id => $tag)
                                    <option value="{{ $id }}">{{ $tag }}</option>
                                @endforeach
                            </x-forms.select>
                        </div>
                        <div class="form-group">
                            <x-forms.select name="assigned_to" class="select2" label="Asignar a">
                                <option></option>
                                @foreach ($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user }}</option>
                                @endforeach
                            </x-forms.select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="exampleFormControlFile1">Subir archivo</label>
                        <input type="file" name="attachment" class="form-control-file @error('attachment') is-invalid @enderror" id="exampleFormControlFile1">
                        @error('attachment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i
                            class="fas fa-save mr-2"></i>Guardar</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="history.back();"><i
                            class="fas fa-ban mr-2"></i>Cancelar</button>
                </div>
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
