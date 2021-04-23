@extends('layouts.login')

@section('header', config('app.name'))

@section('content')
    <p class="login-box-msg">Por favor, inicia tu sesión</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Contraseña">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Mentener sesión</label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <p class="mb-1 mt-3">
        <a href="forgot-password.html">Olvidé mi contraseña</a>
    </p>
@stop
