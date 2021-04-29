<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-users mr-2"></i>Crear usuario</h1>
        </div>
    </x-slot>

    <div class="card">
        <form action="{{ route('users.store') }}" method="POST">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <x-forms.input label="Nombre de usuario" name="name" />
                    </div>
                    <div class="form-group col-6">
                        <x-forms.input label="Correo electrónico" name="email" type="email" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <x-forms.input label="Contraseña" name="password" type="password" />
                    </div>
                    <div class="form-group col-6">
                        <x-forms.input label="Confirmación" name="password_confirmation" type="password" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <x-forms.select label="Seleccionar un grupo" name="group">
                            @foreach ($groups as $group)
                                <option>{{ $group }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
            </div><!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Guardar</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="history.back();"><i class="fas fa-ban mr-2"></i>Cancelar</button>
                </div>
            </div>
        </form>
    </div>

</x-main-layout>
