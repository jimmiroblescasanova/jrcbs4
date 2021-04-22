<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-users mr-2"></i>Crear grupo y permisos</h1>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                @include('groups._form')

                <div class="row mt-3 float-right">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check mr-2"></i>Guardar</button>
                    </div>
                    <div class="form-group ml-3">
                        <button type="button" onclick="history.back();" class="btn btn-default btn-sm"><i class="fas fa-backward mr-2"></i>Atrás</button>
                    </div>
                </div>
            </form>
        </div><!-- /.card-body -->
    </div>

    <x-slot name="custom_scripts">
        <script>
            $(".toggle-all").change(function() {
                var status = $(this).prop('checked') ? 'checked' : false;
                let idName = $(this).parent().parent().parent().attr('id');

                $('.'+idName).prop("checked", status);
            });

            $("input[name='permissions[]']").change(function() {
                let idName = $(this).parent().parent().parent().attr('id');
                console.log(idName);
                countCheckedInputs(idName);
            });

            function countCheckedInputs(id) {
                var inputSize = $('#' + id + ' :checkbox:checked').length;
                var status = $('#all_'+id).prop('checked') ? 'checked' : false;

                if (status == 'checked') {
                    inputSize--;
                }

                if (inputSize >= 3) {
                    $("#all_"+id).prop({
                        indeterminate: false,
                        checked: true
                    });
                } else if(inputSize >= 1){
                    $("#all_"+id).prop({
                        indeterminate: true,
                        checked: false
                    });
                } else {
                    $("#all_"+id).prop({
                        indeterminate: false,
                        checked: false
                    });
                }
            }
        </script>
    </x-slot>
</x-main-layout>
