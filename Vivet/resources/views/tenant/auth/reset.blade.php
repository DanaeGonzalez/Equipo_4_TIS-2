@extends('tenant.layouts.app')

@section('content')
<div class="container">
    <h2>Restablecer Contraseña</h2>

    <form method="POST" action="{{ route('password.reset') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request('token') }}">

        <div class="form-group">
            <label for="password">Nueva contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Cambiar contraseña</button>
    </form>
</div>
@endsection
