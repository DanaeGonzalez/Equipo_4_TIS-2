@extends('tenant.layouts.app')

@section('title', 'Crear Usuario')

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded">
        <strong>¡Ups! Algo salió mal:</strong>
        <ul class="list-disc pl-5 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


@section('content')
<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Crear nuevo usuario</h1>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="lastname" class="block font-medium">Apellido</label>
            <input type="text" name="lastname" id="lastname" class="w-full border rounded p-2" value="{{ old('lastname') }}" required>
        </div>

        <div>
            <label for="run" class="block font-medium">RUN</label>
            <input type="text" name="run" id="run" class="w-full border rounded p-2" value="{{ old('run') }}" required>
        </div>

        <div>
            <label for="sex" class="block font-medium">Sexo</label>
            <select name="sex" id="sex" class="w-full border rounded p-2" required>
                <option value="">Seleccione</option>
                <option value="Hombre" {{ old('sex') == 'Hombre' ? 'selected' : '' }}>Masculino</option>
                <option value="Mujer" {{ old('sex') == 'Mujer' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('sex') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div>
            <label for="email" class="block font-medium">Correo electrónico</label>
            <input type="email" name="email" id="email" class="w-full border rounded p-2" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="role_id" class="block font-medium">Rol</label>
            <select name="role_id" id="role_id" class="w-full border rounded p-2" required>
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="is_active" class="inline-flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="0" {{ old('is_active') ? 'checked' : '' }}>
                ¿Activo?
            </label>
        </div>

        {{--<div>
            <label for="password" class="block font-medium">Contraseña</label>
            <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2" required>
        </div>--}}

        <div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Crear usuario</button>
        </div>
    </form>
</div>
@endsection