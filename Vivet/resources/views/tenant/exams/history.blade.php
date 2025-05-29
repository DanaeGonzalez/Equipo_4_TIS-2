@extends('tenant.layouts.app')

@section('content')

<div class="min-h-screen py-6">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Simple Header -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('exams.index') }}" class="text-teal-600 hover:text-teal-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Historial de Exámenes</h1>
            </div>
            <p class="text-gray-600">Archivos enviados a {{ $user->name }} {{ $user->lastname }} ({{ $user->email }})</p>
        </div>

        @if ($exams->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow border p-8 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay exámenes</h3>
                <p class="text-gray-500 mb-4">Este usuario aún no ha recibido ningún archivo.</p>
                <a href="{{ route('exams.index') }}" 
                   class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 transition-colors">
                    Volver
                </a>
            </div>
        @else
            <!-- Exams Table -->
            <div class="bg-white rounded-lg shadow border overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-teal-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">Archivo</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Enviado por</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Fecha</th>
                            <th class="px-4 py-3 text-center text-sm font-medium">Descargar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($exams as $exam)
                            <tr class="hover:bg-gray-50">
                                <!-- File Info -->
                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-900">{{ $exam->exam_file }}</div>
                                    @php
                                        $extension = strtoupper(pathinfo($exam->exam_file, PATHINFO_EXTENSION));
                                    @endphp
                                    <div class="text-sm text-gray-500">{{ $extension }}</div>
                                </td>
                                
                                <!-- Sender -->
                                <td class="px-4 py-4">
                                    <div class="text-gray-900">{{ $exam->sender->name }} {{ $exam->sender->lastname }}</div>
                                </td>
                                
                                <!-- Date -->
                                <td class="px-4 py-4">
                                    <div class="text-gray-900">{{ $exam->created_at->format('d/m/Y H:i') }}</div>
                                </td>
                                
                                <!-- Download -->
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ asset('storage/exams/' . $exam->exam_file) }}" 
                                       class="bg-teal-600 text-white px-4 py-2 rounded text-sm hover:bg-teal-700 transition-colors" 
                                       download>
                                        Descargar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Simple Summary -->
            <div class="mt-4 bg-white rounded-lg shadow border p-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">Total: {{ $exams->count() }} archivo(s)</span>
                    <a href="{{ route('exams.index') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded text-sm hover:bg-gray-600 transition-colors">
                        Volver
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
