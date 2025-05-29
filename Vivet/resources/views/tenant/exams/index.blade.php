@extends('tenant.layouts.app')

@section('content')

<div class="min-h-screen py-6">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Simple Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Enviar Exámenes a Tutores</h1>
            <p class="text-gray-600">Selecciona un archivo y envíalo</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow border overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-teal-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium">Usuario</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Archivo</th>
                        <th class="px-4 py-3 text-center text-sm font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <form method="POST" action="{{ route('exams.send') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                            
                            <!-- User Info -->
                            <td class="px-4 py-4">
                                <div class="font-medium text-gray-900">{{ $user->name }} {{ $user->lastname }}</div>
                            </td>
                            
                            <!-- Email -->
                            <td class="px-4 py-4 text-gray-700">{{ $user->email }}</td>
                            
                            <!-- File Input -->
                            <td class="px-4 py-4">
                                <input type="file" name="exam_file" accept=".pdf,.doc,.docx" 
                                       class="block w-full text-sm text-gray-500 border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-teal-500" 
                                       required>
                                <p class="mt-1 text-xs text-gray-500">PDF, DOC, DOCX</p>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button type="submit" 
                                            class="bg-teal-600 text-white px-4 py-2 rounded text-sm hover:bg-teal-700 transition-colors">
                                        Enviar
                                    </button>
                                    <a href="{{ route('exams.history', $user->id) }}" 
                                       style="background-color: var(--color-button-primary);" class="text-white px-4 py-2 rounded text-sm transition-colors">
                                        Historial
                                    </a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection