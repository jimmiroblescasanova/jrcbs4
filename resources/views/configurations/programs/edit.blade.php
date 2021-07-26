@extends('layouts.configurations')

@section('content')
    <div class="card">
        <div class="card-header">
            Editar un sistema existente
        </div>
        <form action="{{ route('configurations.programs.update', $program) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('configurations.programs._form')
            </div>
            <div class="card-footer clearfix">
                <a href="{{route('configurations.programs.index')}}" class="btn btn-default btn-sm">Atrás</a>
                <button type="submit" class="btn btn-primary btn-sm float-right">Actualizar sistema</button>
            </div>
        </form>
    </div>
@stop
