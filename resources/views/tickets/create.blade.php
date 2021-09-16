<x-main-layout>
    <x-slot name="header">
        <h1><i class="far fa-calendar-check mr-2"></i>Agregar nueva tarea</h1>
    </x-slot>

    <div class="card">
        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <div class="form-group">
                            <label for="companies">Seleccionar empresa</label>
                            <select class="form-control select2" id="companies" name="company_id">
                                <option></option>
                                @foreach ($companies as $id => $company)
                                <option value="{{ $id }}">{{ $company }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="contacts">Selecciona un contacto</label>
                        <select class="form-control" name="contact_id" id="contacts">
                            <option disabled selected>Primero selecciona una empresa</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <x-forms.select name="activity_id" label="Actividad">
                            @foreach ($activities as $id => $activity)
                            <option value="{{ $id }}">{{ $activity }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <x-forms.select name="tag_id" label="Seleccionar etiqueta">
                            @foreach ($tags as $id => $tag)
                            <option value="{{ $id }}">{{ $tag }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <x-forms.select name="assigned_to" label="Asignar a">
                            @foreach ($users as $id => $user)
                            <option value="{{ $id }}">{{ $user }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-12">
                        <textarea name="note" id="note" class="summernote" rows="10"
                            placeholder="Agrega tus comentarios"></textarea>
                        <small class="text-muted">Máximo 255 carácteres.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="exampleFormControlFile1">Subir archivo</label>
                        <input type="file" name="attachment"
                            class="form-control-file @error('attachment') is-invalid @enderror"
                            id="exampleFormControlFile1">
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

                $('#companies').on('select2:select', function (e) {
                    let company = e.params.data;
                    // console.log(company);

                    $.ajax({
                        // headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                        url: '{{ url('/api/get-contacts') }}',
                        type: 'post',
                        dataType: 'json',
                        data: { 'id': company.id },
                        success: function (response) {
                            const select = $('#contacts');
                            // console.log(Object.keys(response).length);
                            let qty = Object.keys(response).length;
                            // Limpiar select
                            select.empty();
                            if (qty > 0)
                            {
                                $.each(response, function (index, element) {
                                    select.append('<option value="' + index + '">' + element + '</option>');
                                });
                            } else {
                                select.append('<option selected>La empresa no tiene contactos</option>');
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        },
                    });
                });

                $('.summernote').summernote({
                    height: 120,
                    maxHeight: 200,
                    toolbar: [
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['view', ['codeview', 'help']]
                    ]
                });
            });
        </script>
    </x-slot>
</x-main-layout>
