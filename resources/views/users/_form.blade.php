<form action="{{ route('users.store') }}" method="POST">
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
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-check mr-2"></i>Guardar</button>
    </div>
</form>
