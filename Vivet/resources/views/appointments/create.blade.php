@extends('layouts.app')


@section('content')
    <div class="container mx-auto max-w-3xl p-8 bg-gradient-to-br from-white to-gray-100 shadow-xl rounded-2xl mt-10">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-indigo-700"  style="color: var(--color-title);">Reserva tu Cita</h2>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Cliente -->
            <div class="bg-white p-6 rounded-xl shadow grid grid-cols-2 gap-4">
                <h3 class="col-span-2 text-lg font-semibold text-indigo-700"  style="color: var(--color-title);">Datos del Cliente</h3>
                <input type="text" name="name" placeholder="Nombre" class="input" required>
                <input type="text" name="lastname" placeholder="Apellido" class="input" required>
                <input type="text" name="client_run" placeholder="RUT" class="input col-span-2" required>
                <input type="email" name="email" placeholder="Correo Electrónico" class="input col-span-2" required>
                <input type="text" name="phone" placeholder="Teléfono" class="input">
                <input type="text" name="address" placeholder="Dirección" class="input">
            </div>

            <!-- Mascota -->
            <div class="bg-white p-6 rounded-xl shadow grid grid-cols-2 gap-4" >
                <h3 class="col-span-2 text-lg font-semibold "  style="color: var(--color-title);">Datos de la Mascota</h3>
                <input type="text" name="pet_name" placeholder="Nombre" class="input" required>
                <input type="text" name="species" placeholder="Especie" class="input" required>
                <input type="text" name="breed" placeholder="Raza" class="input">
                <input type="text" name="color" placeholder="Color" class="input">
                <select name="sex" class="input" required>
                    <option value="">Seleccione Sexo</option>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
                <input type="date" name="date_of_birth" class="input">
                <input type="text" name="microchip_number" placeholder="Número de Microchip" class="input col-span-2">
                <textarea name="notes" placeholder="Notas" class="input col-span-2"></textarea>
            </div>

            <!-- Servicio y Veterinario -->
            <div class="bg-white p-6 rounded-xl shadow grid grid-cols-2 gap-4">
                <h3 class="col-span-2 text-lg font-semibold" style="color: var(--color-title);"> Servicio y Veterinario</h3>
                <select name="service_id" class="input col-span-2" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }} - ${{ $service->price }}</option>
                    @endforeach
                </select>
                
                <select name="vet_id" class="input col-span-2" required>
                    @foreach($veterinarians as $veterinarian)
                        <option value="{{ $veterinarian->id }}">{{ $veterinarian->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Horario -->
            <div class="bg-white p-6 rounded-2xl shadow-md grid grid-cols-2 gap-4">
                <h3 class="col-span-2 text-lg font-semibold" style="color: var(--color-title);">Horario & Motivo</h3>

                <select name="schedule_id" class="input-elegante col-span-2" required>
                    @php
                        $groupedSchedules = $schedules->groupBy('event_date');
                    @endphp

                    @foreach($groupedSchedules as $date => $daySchedules)
                        <optgroup label="{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}">
                            @foreach($daySchedules as $schedule)
                                <option value="{{ $schedule->id }}">
                                    {{ $schedule->event_time }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>

                <input type="text" name="reason" placeholder="Motivo" class="input-elegante col-span-2" required>
            </div>




            <!--  gaurdar reserva -->
            <button type="submit" style="background-color: var(--color-button-secondary);"
                class="w-full bg-indigo-600 text-white py-3 rounded-xl shadow hover:bg-indigo-700 transition transform hover:scale-105">
                Guardar Cita
            </button>
        </form>
    </div>

    <style>
        .input {
            @apply w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500;
        }
    </style>
@endsection