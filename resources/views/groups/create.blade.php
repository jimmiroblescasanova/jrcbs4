<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-users mr-2"></i>Crear grupo y permisos</h1>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                @include('groups._form')
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-check mr-2"></i>Guardar</button>
                </div>
            </form>

        </div><!-- /.card-body -->
    </div>

    <x-slot name="custom_scripts">
        <script>
            // check companies
            $("#all_companies").change(function() {
                var status = $(this).prop('checked') ? 'checked' : false;
                $(".companies").prop("checked", status);
            });
            $('.companies').change(function() {
                countCheckedInputs('companies')
            });

            // check contacts
            /* $("#all_contacts").change(function() {
                var status = $(this).prop('checked') ? 'checked' : false;
                $(".contacts").prop("checked", status);
            });
            $('.contacts').change(function() {
                countCheckedInputs('contacts')
            }); */

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
