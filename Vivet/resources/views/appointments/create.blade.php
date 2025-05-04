@extends('layouts.app')
<!--este funciona-->
@section('content')
    <div class="container mx-auto max-w-lg p-2 bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">Agendar Cita</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <!-- Cliente -->
            <h3 class="font-semibold mb-2">Datos del Cliente</h3>
            <input type="text" name="first_name" placeholder="Nombre" class="w-full mb-2 p-2 border rounded" required>
            <input type="text" name="last_name" placeholder="Apellido" class="w-full mb-2 p-2 border rounded" required>
            <input type="text" name="rut" placeholder="RUT" class="w-full mb-2 p-2 border rounded" required>
            <input type="email" name="email" placeholder="Correo Electrónico" class="w-full mb-2 p-2 border rounded"
                required>
            <input type="text" name="phone" placeholder="Teléfono" class="w-full mb-2 p-2 border rounded" required>
            <input type="text" name="address" placeholder="Dirección" class="w-full mb-4 p-2 border rounded">

            <!-- Mascota -->
            <h3 class="font-semibold mb-2">Datos de la Mascota</h3>
            <input type="text" name="pet_name" placeholder="Nombre" class="w-full mb-2 p-2 border rounded" required>
            <input type="text" name="species" placeholder="Especie" class="w-full mb-2 p-2 border rounded" required>
            <input type="text" name="breed" placeholder="Raza" class="w-full mb-2 p-2 border rounded">
            <select name="sex" class="w-full mb-2 p-2 border rounded" required>
                <option value="">Seleccione Sexo</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
            <input type="text" name="color" placeholder="Color" class="w-full mb-2 p-2 border rounded">
            <input type="date" name="date_of_birth" placeholder="Fecha de Nacimiento"
                class="w-full mb-2 p-2 border rounded">
            <input type="text" name="microchip_number" placeholder="Número de Microchip"
                class="w-full mb-2 p-2 border rounded">
            <textarea name="notes" placeholder="Notas" class="w-full mb-4 p-2 border rounded"></textarea>

            <!-- Servicio -->
            <h3 class="font-semibold mb-2">Servicio</h3>
            <select name="service_id" class="w-full mb-2 p-2 border rounded" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>

            <!-- Veterinario -->
            <h3 class="font-semibold mb-2">Veterinario</h3>
            <select name="user_id" class="w-full mb-2 p-2 border rounded" required>
                @foreach($veterinarians as $veterinarian)
                    <option value="{{ $veterinarian->id }}">
                        {{ $veterinarian->name }}
                    </option>
                @endforeach
            </select>


            <!-- Horario -->
            <h3 class="font-semibold mb-2">Horario</h3>
            <select name="schedule_id" class="w-full mb-2 p-2 border rounded" required>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->event_date }} - {{ $schedule->event_time }}
                    </option>
                @endforeach
            </select>

            <!-- Fecha de la Cita 
                <input type="datetime-local" name="appointment_date" class="w-full mb-2 p-2 border rounded" required>-->
            <input type="text" name="reason" class="w-full mb-2 p-2 border rounded" placeholder="Motivo" required>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar Cita
            </button>
        </form>
    </div>
@endsection