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
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-check mr-2"></i>Guardar</button>
                </div>
            </form>

        </div><!-- /.card-body -->
    </div>

</x-main-layout>
