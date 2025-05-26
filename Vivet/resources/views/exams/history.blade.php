@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Historial de Exámenes para {{ $user->name }} {{ $user->lastname }}</h1>

    @if ($exams->isEmpty())
        <p class="text-gray-600">Este usuario aún no ha recibido exámenes.</p>
    @else
        <table class="min-w-full border border-gray-300 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Archivo</th>
                    <th class="p-2 border">Enviado por</th>
                    <th class="p-2 border">Fecha de Envío</th>
                    <th class="p-2 border">Descargar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr class="border-t">
                        <td class="p-2 border">{{ $exam->exam_file }}</td>
                        <td class="p-2 border">{{ $exam->sender->name }} {{ $exam->sender->lastname }}</td>
                        <td class="p-2 border">{{ $exam->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-2 border">
                            <a href="{{ asset('storage/exams/' . $exam->exam_file) }}" class="text-blue-600 hover:underline" download>
                                Descargar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
