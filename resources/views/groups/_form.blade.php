<div class="row">
    <div class="col-12">
        <div class="form-group">
            <x-forms.input label="Nombre del grupo" name="group_name" value="{{ old('group_name', $role->name) }}" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <fieldset class="border p-2" id="companies">
            <legend class="w-auto">Empresas</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input"
                    id="all_companies"/>
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input companies"
                    name="permissions[]"
                    value="show companies"
                    {{ ($role->hasPermissionTo('show companies')) ? 'checked' : '' }}>
                    Ver empresas
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input companies"
                    name="permissions[]"
                    value="create companies"
                    {{ ($role->hasPermissionTo('create companies')) ? 'checked' : '' }}>
                    Crear empresas
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input companies"
                    name="permissions[]"
                    value="edit companies"
                    {{ ($role->hasPermissionTo('edit companies')) ? 'checked' : '' }}>
                    Editar empresas
                </label>
            </div>
        </fieldset>
    </div>
    <div class="col-6">
        <fieldset class="border p-2" id="contacts">
            <legend class="w-auto">Contactos</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input"
                    id="all_contacts"/>
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input contacts"
                    name="permissions[]"
                    value="show contacts"
                    {{ ($role->hasPermissionTo('show contacts')) ? 'checked' : '' }}>
                    Ver contactos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input contacts"
                    name="permissions[]"
                    value="create contacts"
                    {{ ($role->hasPermissionTo('create contacts')) ? 'checked' : '' }}>
                    Crear contactos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input
                    type="checkbox"
                    class="form-check-input contacts"
                    name="permissions[]"
                    value="edit contacts"
                    {{ ($role->hasPermissionTo('edit contacts')) ? 'checked' : '' }}>
                    Editar contactos
                </label>
            </div>
        </fieldset>
    </div>
</div>
