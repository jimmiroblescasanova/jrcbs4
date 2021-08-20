<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-envelope mr-2"></i>Enviar correo masivo</h1>
        </div>
    </x-slot>

    <div class="card">
        <form action="{{ route('mailing.store') }}" id="sendMailing" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <fieldset style="margin-bottom: 10px;">
                    <legend>1. Seleccionar destinatarios</legend>
                    @livewire('mailing-form')
                </fieldset>
                <fieldset>
                    <legend>2. Contenido del email</legend>
                    <div class="form-group">
                        <label for="subject">Asunto:</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto">
                    </div>
                    <div class="form-group">
                        <label for="content">Contenido del mensaje</label>
                        <textarea name="content" id="content" class="summernote"></textarea>
                    </div>
                </fieldset>
            </div>

            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Enviar
                        correos</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="history.back();"><i
                            class="fas fa-ban mr-2"></i>Cancelar</button>
                </div>
            </div>
        </form>
    </div>

    <x-slot name="custom_scripts">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/multiselect/2.2.9/js/multiselect.min.js"
            integrity="sha512-i74c9EwGHOqv7lac1ZzOUvb1eQsC97jmpnD2YHQOZET5Op8ZqJZIYuBFgGx5NWgDVTQ76qZ75MWhZJUnLDQPeQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                $('#sendMailing').on('submit', function () {
                    $(this).find('input[type=submit]').attr('disabled', true);
                });

                $('#multiselect').multiselect();

                $('.select2').select2({
                    placeholder: "Selecciona o deja en blanco",
                    allowClear: true
                });

                $('.summernote').summernote({
                    height: 500,
                    maxHeight: 800,
                    toolbar: [
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview', 'help']]
                    ],
                    callbacks: {
                        onImageUpload: function(files, editor, $editable) {
                            sendFile(files[0], editor, $editable);
                        }
                    }
                });

                function sendFile(file, editor, welEditable) {
                    data = new FormData();
                    data.append("file", file);

                    $.ajax({
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                        url:'/api/mailing/store-image',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(data){
                            // console.log(data.url);
                            $('.summernote').summernote("insertImage", data.url, data.filename);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus+" "+errorThrown);
                        }
                    });
                }
            });
        </script>
    </x-slot>
</x-main-layout>
