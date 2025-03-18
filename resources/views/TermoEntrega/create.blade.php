@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 dark:border-gray-700 rounded-xl shadow-lg p-8 border border-gray-100">
            <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-file-text mr-2 text-blue-500 dark:text-blue-400">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" x2="8" y1="13" y2="13" />
                    <line x1="16" x2="8" y1="17" y2="17" />
                    <line x1="10" x2="8" y1="9" y2="9" />
                </svg>
                Criar Novo Termo de Entrega
            </h1>

            <form method="POST" action="{{ route('termo.store') }}" id="termForm" class="space-y-8">
                @csrf

                <!-- Dados do Funcionário -->
                <div
                    class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/50 dark:to-indigo-900/50 rounded-xl shadow-sm border border-blue-100 dark:border-blue-800">
                    <h2 class="text-lg font-semibold mb-4 text-blue-800 dark:text-blue-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user mr-2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Dados do Funcionário
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="employee_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Nome do Funcionário</label>
                            <div class="relative">
                                <input type="text" id="nome" name="nome"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    required>
                                <div
                                    class="absolute inset-0 rounded-lg shadow-inner pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label for="cpf"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">CPF</label>
                            <div class="relative">
                                <input type="text" id="cpf" name="cpf"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    required>
                                <div
                                    class="absolute inset-0 rounded-lg shadow-inner pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Departamento -->
                <div class="p-6 bg-gradient-to-r from-blue-50 to-violet-50 dark:from-blue-900/50 dark:to-violet-900/50 rounded-xl shadow-sm border border-purple-100 dark:border-purple-800">
                    <h2 class="text-lg font-semibold mb-4 text-purple-800 dark:text-purple-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-building-2 mr-2">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z" />
                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" />
                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2" />
                            <path d="M10 6h4" />
                            <path d="M10 10h4" />
                            <path d="M10 14h4" />
                            <path d="M10 18h4" />
                        </svg>
                        Departamento
                    </h2>

                    <div class="group">
                        <label for="secretaria_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-200">Secretaria</label>
                        <div class="relative">
                            <select name="secretaria_id" id="secretaria_id"
                                class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 appearance-none transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                required>
                                <option value="">Selecione uma secretaria</option>
                                @foreach ($secretarias as $secretaria)
                                    <option value="{{ $secretaria->id }}">{{ $secretaria->nome }}</option>
                                @endforeach
                            </select>
                           
                        </div>
                    </div>
                </div>

                <!-- Equipamentos -->
                <div class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/50 dark:to-emerald-900/50 rounded-xl shadow-sm border border-green-100 dark:border-green-800">
                    <h2 class="text-lg font-semibold mb-4 text-green-800 dark:text-green-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-laptop mr-2">
                            <path
                                d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                        </svg>
                        Equipamentos
                    </h2>

                    <!-- Search Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="group">
                            <label for="tipo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">
                                Tipo de Equipamento
                            </label>
                            <div class="relative">
                                <select id="tipo_id" 
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todos os tipos</option>
                                    @foreach($tiposEquipamento as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
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
                        
                        <div class="group">
                            <label for="numero_serie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">
                                Número de Série
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <path d="M4 7V4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H6a2 2 0 0 0-2 2v3" />
                                        <path d="M2 14h12" />
                                        <path d="m9 18 3-3-3-3" />
                                    </svg>
                                </div>
                                <input type="text" id="numero_serie" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Buscar por número de série">
                            </div>
                        </div>
                        
                        <div class="group">
                            <label for="modelo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">
                                Marca/Modelo
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <rect width="18" height="10" x="3" y="11" rx="2" />
                                        <circle cx="12" cy="5" r="2" />
                                        <path d="M12 7v4" />
                                        <line x1="8" x2="16" y1="16" y2="16" />
                                    </svg>
                                </div>
                                <input type="text" id="modelo" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Buscar por marca/modelo">
                            </div>
                        </div>
                        
                        <div class="group flex items-end">
                            <button type="button" id="btnBuscarEquipamentos"
                                class="w-full flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 active:bg-green-800 transition-colors duration-200 shadow-md hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="mr-2">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                                Buscar
                            </button>
                        </div>
                    </div>

                    <!-- Search Results -->
                    <div id="resultadoBusca" class="mt-4 mb-6">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Tipo
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Número de Série
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Marca/Modelo
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="equipamentosNovosTable">
                                        <!-- Resultados da busca serão inseridos aqui via JavaScript -->
                                        <tr id="search-loading" class="hidden">
                                            <td colspan="4" class="px-6 py-4 text-center">
                                                <div class="flex justify-center items-center">
                                                    <div class="animate-spin h-5 w-5 border-t-2 border-b-2 border-green-500 dark:border-green-400 rounded-full mr-3"></div>
                                                    <span class="text-gray-600 dark:text-gray-400">Carregando...</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="search-empty" class="hidden">
                                            <td colspan="4" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                                                <div class="flex flex-col items-center justify-center py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                        class="text-gray-400 mb-3">
                                                        <circle cx="11" cy="11" r="8" />
                                                        <path d="m21 21-4.3-4.3" />
                                                    </svg>
                                                    <p>Nenhum equipamento encontrado.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="search-initial">
                                            <td colspan="4" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                                                <div class="flex flex-col items-center justify-center py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                        class="text-gray-400 mb-3">
                                                        <circle cx="11" cy="11" r="8" />
                                                        <path d="m21 21-4.3-4.3" />
                                                    </svg>
                                                    <p>Use os filtros acima para buscar equipamentos.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="paginacao" class="flex justify-center mt-4">
                            <!-- Paginação será inserida aqui via JavaScript -->
                        </div>
                    </div>

                    <!-- Selected Equipment Section -->
                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="text-green-600 dark:text-green-400 mr-2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Equipamentos Selecionados</h4>
                            </div>
                            <span class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-xs font-medium px-2.5 py-0.5 rounded-full" id="selected-count">
                                0
                            </span>
                        </div>

                        <div id="equipment-container" class="space-y-4">
                            <!-- Equipamentos selecionados serão inseridos aqui via JavaScript -->
                            <div id="no-equipment-selected" class="p-5 border border-green-200 dark:border-green-700 rounded-lg bg-white dark:bg-gray-800 shadow-sm text-center">
                                <div class="flex flex-col items-center justify-center py-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-400 mb-3">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400">Nenhum equipamento selecionado.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('termo.index') }}"
                        class="flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Voltar para lista
                    </a>

                    <button type="submit"
                        class="flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:translate-y-[-2px] active:translate-y-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-save mr-2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Finalizar Termo de Entrega
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alerts Container -->
    <div id="alerts-container" class="fixed top-5 right-5 z-50 w-80 space-y-4"></div>

    <style>
        @keyframes fadeSlideIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeSlideOut {
            0% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        @keyframes fadeSlideLeft {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeSlideRight {
            0% {
                opacity: 1;
                transform: translateX(0);
            }

            100% {
                opacity: 0;
                transform: translateX(100%);
            }
        }
        
        /* Animation for loading state */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        .animate-pulse {
            animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Mostrar alert estilizado
            function showAlert(message, type = 'error') {
                const icons = {
                    success: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                    error: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>',
                    warning: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>',
                    info: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>'
                };

                const colors = {
                    success: 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 border-green-500/30 dark:border-green-500/50 text-green-800 dark:text-green-200',
                    error: 'bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/30 dark:to-rose-900/30 border-red-500/30 dark:border-red-500/50 text-red-800 dark:text-red-200',
                    warning: 'bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/30 dark:to-yellow-900/30 border-amber-500/30 dark:border-amber-500/50 text-amber-800 dark:text-amber-200',
                    info: 'bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/30 dark:to-cyan-900/30 border-blue-500/30 dark:border-blue-500/50 text-blue-800 dark:text-blue-200'
                };

                const alertId = 'alert-' + Date.now();
                const alertHtml = `
                    <div id="${alertId}" class="flex items-center p-4 rounded-xl border shadow-lg ring-1 ring-opacity-5 backdrop-blur-sm ${colors[type]}" 
                         style="animation: fadeSlideLeft 0.3s ease-out forwards; transform: translateX(100%); opacity: 0;">
                        <div class="mr-3 flex-shrink-0">
                            ${icons[type]}
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">${message}</p>
                        </div>
                        <button type="button" class="ml-auto flex-shrink-0 rounded-full p-1.5 hover:bg-black/5 dark:hover:bg-white/10 active:bg-black/10 dark:active:bg-white/20 transition-colors duration-200" onclick="dismissAlert('${alertId}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>
                `;

                $('#alerts-container').append(alertHtml);

                // Auto-dismiss after 5 seconds
                setTimeout(function() {
                    dismissAlert(alertId);
                }, 5000);
            }

            // Função para remover alert
            window.dismissAlert = function(alertId) {
                const alert = $('#' + alertId);
                alert.css('animation', 'fadeSlideRight 0.3s ease-out forwards');
                setTimeout(function() {
                    alert.remove();
                }, 300);
            };

            // Função para atualizar contador de equipamentos
            function updateEquipmentCount() {
                const count = $('.equipment-row').length - ($('#no-equipment-selected').is(':visible') ? 1 : 0);
                $('#selected-count').text(count);
                
                if (count === 0) {
                    $('#no-equipment-selected').show();
                } else {
                    $('#no-equipment-selected').hide();
                }
            }

            // Função para adicionar equipamento à seleção
            window.adicionarEquipamento = function(id, tipo, numero_serie, modelo) {
                // Verificar se o equipamento já está na lista de selecionados
                if ($('#equipment-' + id).length > 0) {
                    showAlert('Este equipamento já foi selecionado.', 'error');
                    return;
                }
                
                // Esconder a mensagem "nenhum equipamento selecionado"
                $('#no-equipment-selected').hide();
                
                // Criar a nova linha de equipamento
                const newRow = `
                    <div id="equipment-${id}" class="equipment-row p-5 border border-green-200 dark:border-green-700 rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-shadow duration-300" style="animation: fadeSlideIn 0.3s ease-out forwards;">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Número de Série -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Número de Série</label>
                                <input type="text" class="serial-number block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                    value="${numero_serie}" readonly>
                            </div>

                            <!-- id equipamento -->
                            <input type="hidden" name="equipamento_id[]" class="equipamento-id" value="${id}">
                            
                            <!-- Tipo de Equipamento -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Tipo de Equipamento</label>
                                <input type="text" class="equipment-type block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                    name="tipo_id[]" value="${tipo}" readonly>
                            </div>

                            <!-- Modelo -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Modelo</label>
                                <input type="text" class="equipment-model block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                    name="modelo[]" value="${modelo}" readonly>
                            </div>
                        </div>

                        <!-- Botão Remover Equipamento -->
                        <div class="mt-4 flex justify-end">
                            <button type="button"
                                class="remove-equipment-btn flex items-center bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 active:bg-red-700 transition-colors duration-200 shadow-sm hover:shadow"
                                title="Remover equipamento">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                Remover
                            </button>
                        </div>
                    </div>
                `;

                $('#equipment-container').append(newRow);
                updateEquipmentCount();
                showAlert('Equipamento adicionado com sucesso!', 'success');
            };

            // Remover equipamento
            $(document).on('click', '.remove-equipment-btn', function() {
                const row = $(this).closest('.equipment-row');

                // Animate removal
                row.css('animation', 'fadeSlideOut 0.3s ease-out forwards');

                // Remove after animation completes
                setTimeout(function() {
                    row.remove();
                    updateEquipmentCount();
                }, 300);
            });

            // Função para buscar equipamentos
            function buscarEquipamentos(page = 1) {
                const tipo_id = $('#tipo_id').val();
                const numero_serie = $('#numero_serie').val();
                const modelo = $('#modelo').val();
                
                // Mostrar indicador de carregamento
                $('#search-initial').addClass('hidden');
                $('#search-empty').addClass('hidden');
                $('#search-loading').removeClass('hidden');
                
                // Limpar resultados anteriores
                const equipamentosNovosTable = $('#equipamentosNovosTable');
                const rows = equipamentosNovosTable.find('tr:not(#search-loading):not(#search-empty):not(#search-initial)');
                rows.remove();
                
                // Fazer a requisição AJAX
                $.ajax({
                    url: '{{ route('equipamentos.search') }}',
                    method: 'GET',
                    data: {
                        tipo_id: tipo_id,
                        numero_serie: numero_serie,
                        modelo: modelo,
                        page: page
                    },
                    success: function(response) {
                        // Esconder indicador de carregamento
                        $('#search-loading').addClass('hidden');
                        
                        if (response.data.length === 0) {
                            // Mostrar mensagem de nenhum resultado
                            $('#search-empty').removeClass('hidden');
                            $('#paginacao').html('');
                            return;
                        }
                        
                        // Preencher a tabela com os resultados
                        $.each(response.data, function(index, equipamento) {
                            const row = `
                                <tr id="resultado-${equipamento.id}" class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        ${equipamento.tipo.nome}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        ${equipamento.numero_serie}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        ${equipamento.modelo}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        <button type="button" onclick="adicionarEquipamento('${equipamento.id}', '${equipamento.tipo.nome}', '${equipamento.numero_serie}', '${equipamento.modelo}')"
                                            class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-800/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="mr-1">
                                                <path d="M12 5v14" />
                                                <path d="M5 12h14" />
                                            </svg>
                                            Adicionar
                                        </button>
                                    </td>
                                </tr>
                            `;
                            
                            equipamentosNovosTable.append(row);
                        });
                        
                        // Construir a paginação
                        renderPagination(response.current_page, response.last_page);
                    },
                    error: function() {
                        $('#search-loading').addClass('hidden');
                        showAlert('Erro ao buscar equipamentos. Tente novamente.', 'error');
                    }
                });
            }
            
            // Função para renderizar a paginação
            function renderPagination(currentPage, lastPage) {
                const paginacaoDiv = $('#paginacao');
                paginacaoDiv.html('');
                
                if (lastPage <= 1) return;
                
                let html = '<ul class="flex items-center -space-x-px h-8 text-sm">';
                
                // Botão anterior
                html += `
                    <li>
                        <button type="button" onclick="buscarEquipamentos(${currentPage > 1 ? currentPage - 1 : 1})" 
                            class="${currentPage === 1 ? 'cursor-not-allowed opacity-50' : ''} flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </button>
                    </li>
                `;
                
                // Páginas numeradas
                const startPage = Math.max(1, currentPage - 2);
                const endPage = Math.min(lastPage, currentPage + 2);
                
                for (let i = startPage; i <= endPage; i++) {
                    html += `
                        <li>
                            <button type="button" onclick="buscarEquipamentos(${i})" 
                                class="${i === currentPage ? 'text-blue-600 bg-blue-50 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'} flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 hover:bg-gray-100 dark:border-gray-700">
                                ${i}
                            </button>
                        </li>
                    `;
                }
                
                // Botão próximo
                html += `
                    <li>
                        <button type="button" onclick="buscarEquipamentos(${currentPage < lastPage ? currentPage + 1 : lastPage})" 
                            class="${currentPage === lastPage ? 'cursor-not-allowed opacity-50' : ''} flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </button>
                    </li>
                `;
                
                html += '</ul>';
                paginacaoDiv.html(html);
            }

            // Event listeners para busca de equipamentos
            $('#btnBuscarEquipamentos').click(function() {
                buscarEquipamentos(1);
            });
            
            // Também buscar equipamentos quando Enter for pressionado nos campos de busca
            $('#numero_serie, #modelo').keypress(function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    buscarEquipamentos(1);
                }
            });

            // Buscar pessoa pelo nome
            $('#nome').on('blur', function() {
                const nome = $(this).val();

                if (nome) {
                    // Adicionar indicador de carregamento
                    $('#cpf').val('Carregando...').addClass('animate-pulse');

                    $.ajax({
                        url: '{{ route('pessoa.buscar-por-nome') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            nome: nome
                        },
                        success: function(response) {
                            // Remover animação de carregamento
                            $('#cpf').removeClass('animate-pulse');

                            if (response.success) {
                                // Preencher o campo de CPF
                                $('#cpf').val(response.pessoa.cpf);
                                $('#nome').val(response.pessoa.nome);
                                showAlert('Pessoa encontrada com sucesso!', 'success');
                            } else {
                                // Limpar o campo de CPF e exibir mensagem de erro
                                $('#cpf').val('');
                                showAlert(response.message, 'error');
                            }
                        },
                        error: function() {
                            // Remover animação de carregamento
                            $('#cpf').removeClass('animate-pulse');

                            // Exibir mensagem de erro
                            showAlert('Erro ao buscar a pessoa.', 'error');
                        }
                    });
                } else {
                    // Limpar o campo de CPF se o nome estiver vazio
                    $('#cpf').val('');
                }
            });

            // Form validation and submission
            $('#termForm').submit(function(e) {
                // Basic validation check
                if ($('.equipamento-id').filter(function() {
                        return $(this).val();
                    }).length === 0) {
                    e.preventDefault();
                    showAlert('Adicione pelo menos um equipamento ao termo de entrega.', 'warning');
                    return false;
                }

                // Show loading state on submit button
                $(this).find('button[type="submit"]').prop('disabled', true).html(`
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processando...
                `);
            });

            // Expor funções globalmente para uso nos botões
            window.buscarEquipamentos = buscarEquipamentos;
            
            // Inicializar contador
            updateEquipmentCount();
        });
    </script>
@endsection

