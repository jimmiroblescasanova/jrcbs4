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
                    <input type="checkbox" class="form-check-input toggle-all" id="all_companies" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input companies" name="permissions[]"
                        value="show companies" {{ ($role->hasPermissionTo('show companies')) ? 'checked' : '' }}>
                    Ver empresas
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input companies" name="permissions[]"
                        value="create companies" {{ ($role->hasPermissionTo('create companies')) ? 'checked' : '' }}>
                    Crear empresas
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input companies" name="permissions[]"
                        value="edit companies" {{ ($role->hasPermissionTo('edit companies')) ? 'checked' : '' }}>
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
                    <input type="checkbox" class="form-check-input toggle-all" id="all_contacts" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input contacts" name="permissions[]" value="show contacts"
                        {{ ($role->hasPermissionTo('show contacts')) ? 'checked' : '' }}>
                    Ver contactos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input contacts" name="permissions[]"
                        value="create contacts" {{ ($role->hasPermissionTo('create contacts')) ? 'checked' : '' }}>
                    Crear contactos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input contacts" name="permissions[]" value="edit contacts"
                        {{ ($role->hasPermissionTo('edit contacts')) ? 'checked' : '' }}>
                    Editar contactos
                </label>
            </div>
        </fieldset>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <fieldset class="border p-2" id="tickets">
            <legend class="w-auto">Tickets</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input toggle-all" id="all_tickets" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input tickets" name="permissions[]" value="show tickets"
                        {{ ($role->hasPermissionTo('show tickets')) ? 'checked' : '' }}>
                    Ver tickets
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input tickets" name="permissions[]" value="create tickets"
                        {{ ($role->hasPermissionTo('create tickets')) ? 'checked' : '' }}>
                    Crear tickets
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input tickets" name="permissions[]" value="edit tickets"
                        {{ ($role->hasPermissionTo('edit tickets')) ? 'checked' : '' }}>
                    Editar tickets
                </label>
            </div>
        </fieldset>
    </div>
    <div class="col-6">
        <fieldset class="border p-2" id="users">
            <legend class="w-auto">Usuarios</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input toggle-all" id="all_users" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input users" name="permissions[]" value="show users"
                        {{ ($role->hasPermissionTo('show users')) ? 'checked' : '' }}>
                    Ver usuarios
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input users" name="permissions[]" value="create users"
                        {{ ($role->hasPermissionTo('create users')) ? 'checked' : '' }}>
                    Crear usuarios
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input users" name="permissions[]" value="edit users"
                        {{ ($role->hasPermissionTo('edit users')) ? 'checked' : '' }}>
                    Editar usuarios
                </label>
            </div>
        </fieldset>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <fieldset class="border p-2" id="activities">
            <legend class="w-auto">Actividades</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input toggle-all" id="all_activities" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input activities" name="permissions[]"
                        value="show activities" {{ ($role->hasPermissionTo('show activities')) ? 'checked' : '' }}>
                    Ver actividades
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input activities" name="permissions[]"
                        value="create activities" {{ ($role->hasPermissionTo('create activities')) ? 'checked' : '' }}>
                    Crear actividades
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input activities" name="permissions[]"
                        value="edit activities" {{ ($role->hasPermissionTo('edit activities')) ? 'checked' : '' }}>
                    Editar actividades
                </label>
            </div>
        </fieldset>
    </div>
    <div class="col-6">
        <fieldset class="border p-2" id="tags">
            <legend class="w-auto">Etiquetas</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input toggle-all" id="all_tags" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input tags" name="permissions[]" value="show tags"
                        {{ ($role->hasPermissionTo('show tags')) ? 'checked' : '' }}>
                    Ver etiquetas
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input tags" name="permissions[]" value="create tags"
                        {{ ($role->hasPermissionTo('create tags')) ? 'checked' : '' }}>
                    Crear etiquetas
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input tags" name="permissions[]" value="edit tags"
                        {{ ($role->hasPermissionTo('edit tags')) ? 'checked' : '' }}>
                    Editar etiquetas
                </label>
            </div>
        </fieldset>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <fieldset class="border p-2" id="groups">
            <legend class="w-auto">Grupos</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input toggle-all" id="all_groups" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input groups" name="permissions[]" value="show groups"
                        {{ ($role->hasPermissionTo('show groups')) ? 'checked' : '' }}>
                    Ver grupos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input groups" name="permissions[]" value="create groups"
                        {{ ($role->hasPermissionTo('create groups')) ? 'checked' : '' }}>
                    Crear grupos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input groups" name="permissions[]" value="edit groups"
                        {{ ($role->hasPermissionTo('edit groups')) ? 'checked' : '' }}>
                    Editar grupos
                </label>
            </div>
        </fieldset>
    </div>
    <div class="col-6">
        <fieldset class="border p-2">
            <legend class="w-auto">Hosts</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permissions[]" value="edit hosts"
                        {{ ($role->hasPermissionTo('edit hosts')) ? 'checked' : '' }}>
                    Editar hosts
                </label>
            </div>
        </fieldset>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <fieldset class="border p-2" id="programs">
            <legend class="w-auto">Programas</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input toggle-all" id="all_programs" />
                    Todos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input programs" name="permissions[]" value="show programs"
                        {{ ($role->hasPermissionTo('show programs')) ? 'checked' : '' }}>
                    Ver grupos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input programs" name="permissions[]"
                        value="create programs" {{ ($role->hasPermissionTo('create programs')) ? 'checked' : '' }}>
                    Crear grupos
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input programs" name="permissions[]" value="edit programs"
                        {{ ($role->hasPermissionTo('edit programs')) ? 'checked' : '' }}>
                    Editar grupos
                </label>
            </div>
        </fieldset>
    </div>
    <div class="col-6">
        <fieldset class="border p-2">
            <legend class="w-auto">Mailings</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permissions[]" value="show mailings"
                        {{ ($role->hasPermissionTo('show mailings')) ? 'checked' : '' }}>
                    Ver mailing
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permissions[]" value="create mailings"
                        {{ ($role->hasPermissionTo('create mailings')) ? 'checked' : '' }}>
                    Crear Mailing
                </label>
            </div>
        </fieldset>
    </div>
</div>
