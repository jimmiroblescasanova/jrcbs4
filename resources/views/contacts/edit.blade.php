<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-edit mr-2"></i>Editar un contacto</h1>
        </div>
        @can('edit contacts')
        <div class="col-sm-6">
            <button type="button" onclick="confirmDeletion();" class="btn btn-sm btn-danger float-right">
                <i class="fas fa-trash-alt mr-2"></i>Eliminar
            </button>
            <form action="{{ route('contacts.delete', $contact) }}" id="delete-contact-form" class="d-none" method="POST">
                @csrf @method('DELETE')
            </form>
        </div>
        @endcan
    </x-slot>

    @if(session()->has('error'))
        <x-partials.alert type="danger" :message="session('error')" icon="fas fa-ban"></x-partials.alert>
    @endif

    <div class="card">
        <form action="{{ route('contacts.update', $contact) }}" method="POST" autocomplete="off">
            @csrf
            @method('PATCH')
            @include('contacts._form')
            <div class="card-footer">
                <div class="float-right">
                    @can('edit contacts')
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i>Actualizar contacto</button>
                    @endcan
                    <button type="button" class="btn btn-default btn-sm" onclick="history.back();"><i class="fas fa-ban mr-2"></i>Cancelar</button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Selecciona o deja en blanco",
                    allowClear: true
                });
            });

            function confirmDeletion(e) {
                swal({
                    title: "Confirmar",
                    text: "Se eliminará el contacto, no se podrá recuperar finalizado el proceso.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                            if (willDelete) {
                                $('#delete-contact-form').submit();
                            }
                        }
                    );
            }
        </script>
    @endpush

</x-main-layout>
