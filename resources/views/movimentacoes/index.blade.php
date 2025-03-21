@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300">
        <!-- Header -->
        <div class="bg-gradient-to-r from-yellow-500 to-amber-600 dark:from-yellow-600 dark:to-amber-700 px-6 py-5">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="text-white">
                        <path d="M12 22H5a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v4" />
                        <path d="M9 2v5" />
                        <path d="M15 2v5" />
                        <path d="M2 12h20" />
                        <circle cx="16" cy="19" r="2" />
                        <path d="M16 11v6" />
                        <path d="M22 19h-4" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white">Movimentações Gerais</h3>
                </div>
                
                <!-- Stats Summary -->
                <div class="flex flex-wrap gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-1.5 text-white text-sm font-medium">
                        <span>Total: {{ $atividadesRecentes->total() }}</span>
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Formulário de Filtros -->
            <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 mb-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="text-yellow-500 dark:text-yellow-400 mr-2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                    Filtros de Pesquisa
                </h4>
                
                <form method="GET" action="{{ route('movimentacoes.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Filtro por Usuário -->
                        <div class="group">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors duration-200">
                                Usuário
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </div>
                                <select name="user_id" id="user_id" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todos os Usuários</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro por Data Inicial -->
                        <div class="group">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors duration-200">
                                Data Inicial
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" x2="16" y1="2" y2="6" />
                                        <line x1="8" x2="8" y1="2" y2="6" />
                                        <line x1="3" x2="21" y1="10" y2="10" />
                                    </svg>
                                </div>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200">
                            </div>
                        </div>

                        <!-- Filtro por Data Final -->
                        <div class="group">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors duration-200">
                                Data Final
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" x2="16" y1="2" y2="6" />
                                        <line x1="8" x2="8" y1="2" y2="6" />
                                        <line x1="3" x2="21" y1="10" y2="10" />
                                    </svg>
                                </div>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200">
                            </div>
                        </div>
                    </div>

                    <!-- Botões de Filtro -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" name="filter" value="recentes"
                            class="flex items-center px-4 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 active:bg-yellow-700 transition-colors duration-200 shadow-sm hover:shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="mr-2">
                                <polyline points="23 4 23 10 17 10" />
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                            </svg>
                            Recentes
                        </button>
                        <button type="submit" name="filter" value="aplicar"
                            class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm hover:shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="mr-2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                            Aplicar Filtros
                        </button>
                        <a href="{{ route('movimentacoes.index') }}"
                            class="flex items-center px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 active:bg-gray-700 transition-colors duration-200 shadow-sm hover:shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="mr-2">
                                <path d="M3 3h18v18H3z" />
                                <path d="M15 9h0" />
                                <path d="M9 15h0" />
                                <path d="m15 15-6-6" />
                            </svg>
                            Limpar Filtros
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabela de Movimentações -->
            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Equipamento
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Ação
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Usuário
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Data
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($atividadesRecentes as $atividade)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                    class="text-gray-600 dark:text-gray-300">
                                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                                    <path d="M16 2v5" />
                                                    <path d="M8 2v5" />
                                                    <path d="M12 14v3" />
                                                    <path d="M2 10h20" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $atividade->equipamento->tipo->nome }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Patrimônio: {{ $atividade->equipamento->patrimonio ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $actionClasses = match(strtolower($atividade->acao)) {
                                                'atribuído', 'atribuido' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                'removido' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                                default => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200'
                                            };
                                            
                                            $actionIcon = match(strtolower($atividade->acao)) {
                                                'atribuído', 'atribuido' => '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" /><polyline points="22 4 12 14.01 9 11.01" /></svg>',
                                                'removido' => '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><circle cx="12" cy="12" r="10" /><line x1="15" x2="9" y1="9" y2="15" /><line x1="9" x2="15" y1="9" y2="15" /></svg>',
                                                default => '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><circle cx="12" cy="12" r="10" /><path d="M12 16v.01" /><path d="M12 8v4" /></svg>'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $actionClasses }}">
                                            {!! $actionIcon !!}
                                            {{ $atividade->acao }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 dark:text-gray-300 font-semibold">{{ substr($atividade->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $atividade->user->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700 dark:text-gray-300">{{ $atividade->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $atividade->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('movimentacoes.detalhes', $atividade->id) }}"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="mr-1">
                                                <circle cx="11" cy="11" r="8" />
                                                <path d="m21 21-4.3-4.3" />
                                                <path d="M11 8v6" />
                                                <path d="M8 11h6" />
                                            </svg>
                                            Detalhes
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="text-gray-400 mb-3">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="12" x2="12" y1="8" y2="12" />
                                                <line x1="12" x2="12.01" y1="16" y2="16" />
                                            </svg>
                                            <p class="text-lg font-medium">Nenhuma movimentação encontrada</p>
                                            <p class="mt-1">Tente ajustar os filtros ou verificar mais tarde.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginação -->
            <div class="mt-6">
                {{ $atividadesRecentes->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional dark mode color for slightly lighter than gray-700 */
    .dark .dark\:bg-gray-750 {
        background-color: rgba(55, 65, 81, 0.5);
    }
    
    /* Hover effect for dark mode table rows */
    .dark .dark\:hover\:bg-gray-750:hover {
        background-color: rgba(55, 65, 81, 0.8);
    }
</style>
@endsection

