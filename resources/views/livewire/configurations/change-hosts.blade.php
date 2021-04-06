<div class="card">
    <div class="card-header">
        <h3 class="card-title">Configuraciones del host</h3>
    </div>
    <form role="form" wire:submit.prevent='save'>
        <div class="card-body">
            @if (session()->has('message'))
                <x-partials.alert type="success" icon="fas fa-check" :message="session('message')" />
            @endif
            <div class="row">
                <div class="form-group col-12 col-md-8">
                    <x-forms.input label="URL del hostname" modelName="sql_host" />
                </div>
                <div class="form-group col-12 col-md-4">
                    <x-forms.input type="number" label="Puerto del hostname" modelName="sql_port" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <x-forms.input label="Nombre de la base de datos" modelName="sql_bdd_name" />
                </div>
                <div class="form-group col-12 col-md-3">
                    <x-forms.input label="Usuario SQL Server" modelName="sql_user" />
                </div>
                <div class="form-group col-12 col-md-3">
                    <x-forms.input label="Contraseña SQL Server" modelName="sql_pswd" />
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">Actualizar datos</button>
            <button type="button" class="btn btn-default btn-sm float-right" onClick="history.back();">Atrás</button>
        </div>
    </form>
    <!-- /.card-footer-->
</div>
