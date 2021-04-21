<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="fas fa-users mr-2"></i>Editar usuario</h1>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-6">
                        <x-forms.input label="Nombre de usuario" name="name" :value="$user->name" />
                    </div>
                    <div class="form-group col-6">
                        <x-forms.input label="Correo electrónico" name="email" type="email" :value="$user->email" />
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
                                <option {{ $user->hasRole($group) ? 'selected' : '' }}>{{ $group }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-check mr-2"></i>Guardar</button>
                </div>
            </form>
        </div><!-- /.card-body -->
    </div>

</x-main-layout>
