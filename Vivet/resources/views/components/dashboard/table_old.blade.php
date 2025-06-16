<!-- resources/views/components/dashboard/table.blade.php -->

@props([
'headers' => [],
'rows' => [],
'actions' => ['edit', 'delete', 'view'],
])

<div class="bg-gray-100 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-4">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600" />
                    </th>
                    @foreach ($headers as $header)
                    <th class="px-6 py-3">{{ $header }}</th>
                    @endforeach
                    <th class="px-6 py-3 text-center whitespace-nowrap">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600" />
                    </td>
                    @foreach ($row['columns'] as $column)
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ $column }}</td>
                    @endforeach
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex items-center gap-x-3">
                            @if (in_array('edit', $actions))
                            <a href="#" data-tooltip-target="tooltip-edit" data-tooltip-placement="top">
                                <svg class="w-6 h-6 text-gray-600 dark:text-white hover:text-blue-800 dark:hover:text-blue-400 transform hover:scale-110 transition duration-200"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                </svg>
                            </a>
                            <div id="tooltip-edit" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Editar
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            @endif
                            @if (in_array('delete', $actions))
                            <a href="#" data-tooltip-target="tooltip-delete" data-tooltip-placement="top">
                                <svg class="w-6 h-6 text-gray-600 dark:text-white hover:text-red-800 dark:hover:text-red-400 transform hover:scale-110 transition duration-200"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <div id="tooltip-delete" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Borrar
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            @endif
                            @if (in_array('view', $actions))
                            <a href="#" data-tooltip-target="tooltip-view" data-tooltip-placement="top">
                                <svg class="w-6 h-6 text-gray-600 dark:text-white hover:text-blue-800 dark:hover:text-blue-400 transform hover:scale-110 transition duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            <div id="tooltip-view" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Ver
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($headers) + 2 }}" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        No hay datos disponibles.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>