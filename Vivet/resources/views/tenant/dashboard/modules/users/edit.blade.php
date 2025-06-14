@extends('tenant.layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-semibold">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label for="lastname" class="block font-semibold">Apellido</label>
                <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname) }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label for="email" class="block font-semibold">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label for="run" class="block font-semibold">RUN</label>
                <input type="text" name="run" id="run" value="{{ old('run', $user->run) }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="sex" class="block font-semibold">Sexo:</label>
                <select name="sex" id="sex" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">Seleccione</option>
                    <option value="Hombre" {{ $user->sex == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="Mujer" {{ $user->sex == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    <option value="Otro" {{ $user->sex == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            

            <div>
                <label for="role_id" class="block font-semibold">Rol</label>
                <select name="role_id" id="role_id" class="w-full border px-3 py-2 rounded">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(auth()->id() !== $user->id)
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" {{ $user->is_active ? 'checked' : '' }} class="mr-2">
                <label for="is_active">Usuario activo</label>
            </div>
            @endif

            {{--<div>
                <label for="password" class="block font-semibold">Contraseña (dejar en blanco si no deseas
                    cambiarla)</label>
                <input type="password" name="password" id="password" class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border px-3 py-2 rounded">
            </div>--}}

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Actualizar Usuario
            </button>
        </form>
    </div>
@endsection