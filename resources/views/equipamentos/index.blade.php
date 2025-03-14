@extends('layouts.app')

@section('title', 'Equipamentos')

@section('content')
    <div class="container mx-auto px-4 py-8 ">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <!-- Header with Title and Action Button -->
            <div class="flex flex-col md:flex-row justify-between items-center p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400">
                        <path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Equipamentos</h1>
                </div>
                <a href="{{ route('equipamentos.create') }}"
                    class="mt-4 md:mt-0 inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:translate-y-[-1px] active:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Novo Equipamento
                </a>
            </div>

            <!-- Filtros e Pesquisa -->
            <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                <form action="{{ route('equipamentos.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Filtro por Secretaria -->
                        <div class="group">
                            <label for="secretaria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Secretaria
                            </label>
                            <div class="relative">
                                <select name="secretaria" id="secretaria"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todas</option>
                                    @foreach ($secretarias as $secretaria)
                                        <option value="{{ $secretaria->id }}"
                                            {{ request('secretaria') == $secretaria->id ? 'selected' : '' }}>
                                            {{ $secretaria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro por Status -->
                        <div class="group">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Status
                            </label>
                            <div class="relative">
                                <select name="status" id="status"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todos</option>
                                    <option value="estoque" {{ request('status') === 'estoque' ? 'selected' : '' }}>Estoque</option>
                                    <option value="em_uso" {{ request('status') === 'em_uso' ? 'selected' : '' }}>Em uso</option>
                                    <option value="manutencao" {{ request('status') === 'manutencao' ? 'selected' : '' }}>Em manutenção</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Campo de Pesquisa -->
                        <div class="group">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Pesquisar
                            </label>
                            <div class="relative">
                                <input type="text" name="search" id="search"
                                    class="block w-full px-4 py-3 pl-10 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Número de série, Modelo" value="{{ request('search') }}">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Botão de Pesquisa -->
                        <div class="self-end">
                            <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-5 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors duration-300 shadow-sm hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M3 6h18" />
                                    <path d="M7 12h10" />
                                    <path d="M10 18h4" />
                                </svg>
                                Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Contador de resultados -->
            <div class="px-6 pt-4 pb-2 flex items-center text-sm text-gray-600 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M7 7h.01" />
                    <path d="M10.05 7.05h5.9v5.9h-5.9z" />
                    <path d="M7 13h.01" />
                    <path d="M7 17h.01" />
                    <path d="M13 17h4" />
                </svg>
                <span>Exibindo <span class="font-medium text-gray-800 dark:text-gray-200">{{ $equipamentos->count() }}</span> de <span class="font-medium text-gray-800 dark:text-gray-200">{{ $equipamentos->total() }}</span> equipamentos</span>
            </div>

            <!-- Tabela de Equipamentos -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Nº Série
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Modelo
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($equipamentos as $equipamento)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('equipamentos.detalhes', $equipamento->id) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors duration-200">
                                        {{ $equipamento->numero_serie }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 dark:text-gray-300">
                                    {{ $equipamento->tipo->nome }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 dark:text-gray-300">
                                    {{ $equipamento->modelo }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClasses = [
                                            'estoque' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                            'em_uso' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                            'manutencao' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                        ];
                                        $statusTexts = [
                                            'estoque' => 'Estoque',
                                            'em_uso' => 'Em Uso',
                                            'manutencao' => 'Em Manutenção',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$equipamento->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $statusTexts[$equipamento->status] ?? $equipamento->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('equipamentos.edit', $equipamento->id) }}"
                                           class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200"
                                           title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('equipamentos.detalhes', $equipamento->id) }}"
                                           class="text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200"
                                           title="Detalhes">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                                <line x1="8" x2="16" y1="10" y2="10" />
                                                <line x1="8" x2="14" y1="14" y2="14" />
                                                <line x1="8" x2="10" y1="18" y2="18" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                                                onclick="return confirm('Tem certeza que deseja excluir este equipamento?')"
                                                title="Excluir">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                    <line x1="10" x2="10" y1="11" y2="17" />
                                                    <line x1="14" x2="14" y1="11" y2="17" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-gray-400">
                                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                            <line x1="8" x2="16" y1="12" y2="12" />
                                        </svg>
                                        <span class="text-lg font-medium">Nenhum equipamento encontrado</span>
                                        <p class="mt-1 text-sm">Tente ajustar os filtros ou adicione um novo equipamento</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                {{ $equipamentos->links() }}
            </div>
        </div>
    </div>

    <style>
        /* Additional dark mode color for slightly lighter than gray-700 */
        .dark .dark\:bg-gray-750 {
            background-color: rgba(55, 65, 81, 0.8);
        }
        
        /* Hover effect for dark mode table rows */
        .dark .dark\:hover\:bg-gray-750:hover {
            background-color: rgba(55, 65, 81, 0.5);
        }
    </style>
@endsection