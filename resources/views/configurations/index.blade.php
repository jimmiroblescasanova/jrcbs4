@extends('layouts.configurations')

@section('content')
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title"><i class="fas fa-key mr-2"></i>Configuraciones del host</h3>
    </div>
    <form action="{{ route('configurations.hosts.update') }}" method="POST" role="form">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="row">
                <div class="form-group col-12 col-md-8">
                    <x-forms.input type="text" name="sql_host" :value="$data['sql_host']">URL del hostname
                    </x-forms.input>
                </div>
                <div class="form-group col-12 col-md-4">
                    <x-forms.input type="number" name="sql_port" :value="$data['sql_port']">Puerto del hostname
                    </x-forms.input>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <x-forms.input type="text" name="sql_bdd_name" :value="$data['sql_bdd_name']">Nombre de la base de
                        datos</x-forms.input>
                </div>
                <div class="form-group col-12 col-md-3">
                    <x-forms.input type="text" name="sql_user" :value="$data['sql_user']">Usuario SQL Server
                    </x-forms.input>
                </div>
                <div class="form-group col-12 col-md-3">
                    <x-forms.input type="text" name="sql_pswd" :value="$data['sql_pswd']">Contraseña SQL Server
                    </x-forms.input>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        @can('edit hosts')
        <div class="card-footer">
            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i>Actualizar
                    datos</button>
            </div>
        </div>
        @endcan
    </form>
    <!-- /.card-footer-->
</div>
@stop
