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
                    <x-forms.input wire:model.lazy="sql_host" name="sql_host">URL del hostname</x-forms.input>
                </div>
                <div class="form-group col-12 col-md-4">
                    <x-forms.input wire:model.lazy="sql_port" type="number" name="sql_port">Puerto del hostname</x-forms.input>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <x-forms.input wire:model.lazy="sql_bdd_name" name="sql_bdd_name">Nombre de la base de datos</x-forms.input>
                </div>
                <div class="form-group col-12 col-md-3">
                    <x-forms.input wire:model.lazy="sql_user" name="sql_user">Usuario SQL Server</x-forms.input>
                </div>
                <div class="form-group col-12 col-md-3">
                    <x-forms.input wire:model.lazy="sql_pswd" name="sql_pswd">Contraseña SQL Server</x-forms.input>
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
