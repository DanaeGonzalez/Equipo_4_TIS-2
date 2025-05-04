@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Editar Horario</h2>

    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Fecha</label>
            <input type="date" name="event_date" value="{{ $schedule->event_date }}" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Hora</label>
            <input type="time" name="event_time" value="{{ $schedule->event_time }}" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
    </form>
</div>
@endsection
