@extends('layouts.app')

@section('content')
    <h1>Detalle del Rol</h1>
    <p><strong>Nombre:</strong> {{ $role->name }}</p>
    <p><strong>Estado:</strong> {{ $role->is_active ? 'Activo' : 'Inactivo' }}</p>

    <a href="{{ route('roles.index') }}">Volver a la lista</a>
@endsection
