@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="text-white">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white">Editar Termo de Entrega #{{ $termoEntrega->id }}</h3>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-6 md:p-8">
            @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="mr-2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" x2="12" y1="8" y2="12" />
                        <line x1="12" x2="12.01" y1="16" y2="16" />
                    </svg>
                    <span class="font-medium">Por favor, corrija os seguintes erros:</span>
                </div>
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Success Alert (Hidden by default) -->
            <div id="success-alert" class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/30 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg hidden">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="mr-2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <span id="success-message" class="font-medium"></span>
                </div>
            </div>

            <!-- Error Alert (Hidden by default) -->
            <div id="error-alert" class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg hidden">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="mr-2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" x2="12" y1="8" y2="12" />
                        <line x1="12" x2="12.01" y1="16" y2="16" />
                    </svg>
                    <span id="error-message" class="font-medium"></span>
                </div>
            </div>

            <form method="POST" action="{{ route('termo.update', $termoEntrega->id) }}" id="formEditTermo">
                @csrf
                @method('PUT')

                <!-- Responsible Person Information -->
                <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 mb-8">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                            class="text-blue-500 dark:text-blue-400 mr-2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Dados do Responsável</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nome do Responsável -->
                        <div class="group">
                            <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Nome do Responsável
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
                                <input type="text" id="nome" name="nome" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    value="{{ $termoEntrega->responsavel->nome }}" required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Digite o nome para buscar automaticamente o CPF</p>
                        </div>

                        <!-- CPF do Responsável -->
                        <div class="group">
                            <label for="cpf" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                CPF do Responsável
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                        <path d="M7 7h.01" />
                                        <path d="M10.05 7.05h5.9v5.9h-5.9z" />
                                        <path d="M7 13h.01" />
                                        <path d="M7 17h.01" />
                                        <path d="M13 17h4" />
                                    </svg>
                                </div>
                                <input type="text" id="cpf" name="cpf" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    value="{{ $termoEntrega->responsavel->cpf }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="group">
                            <label for="secretaria_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Secretaria
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        <polyline points="9 22 9 12 15 12 15 22" />
                                    </svg>
                                </div>
                                <select id="secretaria_id" name="secretaria_id" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none"
                                    required>
                                    <option value="">Selecione uma secretaria</option>
                                    @foreach($secretarias as $secretaria)
                                    <option value="{{ $secretaria->id }}" {{ $termoEntrega->secretaria_id == $secretaria->id ? 'selected' : '' }}>
                                        {{ $secretaria->nome }}
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
                    </div>

                    <div class="mt-6">
                        <div class="group">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Observações
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="text-gray-500 dark:text-gray-400">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                                        <path d="M9 9h1" />
                                        <path d="M9 13h6" />
                                        <path d="M9 17h6" />
                                    </svg>
                                </div>
                                <textarea id="observacoes" name="observacoes" rows="3" 
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200">{{ $termoEntrega->observacoes }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Equipment Section -->
                <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="text-blue-500 dark:text-blue-400 mr-2">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                <path d="M16 2v5" />
                                <path d="M8 2v5" />
                                <path d="M12 14v3" />
                                <path d="M2 10h20" />
                            </svg>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Equipamentos Atuais</h4>
                        </div>
                        <span class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-xs font-medium px-2.5 py-0.5 rounded-full" id="current-equipment-count">
                            {{ count($equipamentosAssociados) }}
                        </span>
                    </div>

                    <!-- Current Equipment Table -->
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
                                            Modelo
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="equipamentosAtuaisTable">
                                    @foreach($equipamentosAssociados as $equipamento)
                                    <tr id="equipamento-atual-{{ $equipamento->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $equipamento->tipo->nome }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $equipamento->numero_serie }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $equipamento->modelo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            <input type="hidden" name="equipamentos_atuais[{{ $equipamento->id }}]" value="{{ $equipamento->id }}">
                                            <button type="button" onclick="removerEquipamentoAtual('{{ $equipamento->id }}')"
                                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" 
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                    class="mr-1">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                </svg>
                                                Remover
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr id="no-current-equipment" class="{{ count($equipamentosAssociados) > 0 ? 'hidden' : '' }}">
                                        <td colspan="4" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                                            <div class="flex flex-col items-center justify-center py-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                    class="text-gray-400 mb-3">
                                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                                    <path d="M12 7v14" />
                                                    <path d="M2 14h20" />
                                                </svg>
                                                <p>Nenhum equipamento associado a este termo.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add New Equipment Section -->
                <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 mb-8">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                            class="text-blue-500 dark:text-blue-400 mr-2">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Adicionar Novos Equipamentos</h4>
                    </div>

                    <!-- Search Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="group">
                            <label for="tipo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Tipo de Equipamento
                            </label>
                            <div class="relative">
                                <select id="tipo_id" 
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
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
                            <label for="numero_serie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
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
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Buscar por número de série">
                            </div>
                        </div>
                        
                        <div class="group">
                            <label for="modelo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
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
                                    class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Buscar por marca/modelo">
                            </div>
                        </div>
                        
                        <div class="group flex items-end">
                            <button type="button" id="btnBuscarEquipamentos"
                                class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-md hover:shadow-lg">
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
                    <div id="resultadoBusca" class="mt-4">
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
                                                    <div class="animate-spin h-5 w-5 border-t-2 border-b-2 border-blue-500 dark:border-blue-400 rounded-full mr-3"></div>
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
                </div>

                <!-- Selected New Equipment Section -->
                <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="text-green-500 dark:text-green-400 mr-2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Novos Equipamentos Selecionados</h4>
                        </div>
                        <span class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-xs font-medium px-2.5 py-0.5 rounded-full" id="new-equipment-count">
                            0
                        </span>
                    </div>

                    <!-- Selected Equipment Table -->
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
                                            Modelo
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="equipamentosSelecionadosTable">
                                    <!-- Equipamentos selecionados serão inseridos aqui via JavaScript -->
                                    <tr id="no-selected-equipment">
                                        <td colspan="4" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                                            <div class="flex flex-col items-center justify-center py-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                    class="text-gray-400 mb-3">
                                                    <path d="M12 5v14" />
                                                    <path d="M5 12h14" />
                                                </svg>
                                                <p>Nenhum novo equipamento selecionado.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap justify-between items-center mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('termo.show', $termoEntrega->id) }}"
                        class="flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200 mb-2 sm:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                            class="mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Cancelar
                    </a>
                    
                    <button type="submit"
                        class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:translate-y-[-2px] active:translate-y-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                            class="mr-2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Atualizar Termo
                    </button>
                </div>
            </form>
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

@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to show alerts
        function showAlert(message, type) {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            
            if (type === 'success') {
                successMessage.textContent = message;
                successAlert.classList.remove('hidden');
                errorAlert.classList.add('hidden');
                
                // Hide success alert after 5 seconds
                setTimeout(() => {
                    successAlert.classList.add('hidden');
                }, 5000);
            } else {
                errorMessage.textContent = message;
                errorAlert.classList.remove('hidden');
                successAlert.classList.add('hidden');
                
                // Hide error alert after 5 seconds
                setTimeout(() => {
                    errorAlert.classList.add('hidden');
                }, 5000);
            }
        }
        
        // Buscar pessoa pelo nome
        const nomeInput = document.getElementById('nome');
        const cpfInput = document.getElementById('cpf');
        
        nomeInput.addEventListener('blur', function() {
            const nome = this.value.trim();
            
            if (nome) {
                // Adicionar indicador de carregamento
                cpfInput.value = 'Carregando...';
                cpfInput.classList.add('animate-pulse');
                
                // Create form data
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('nome', nome);
                
                // Fetch API
                fetch('{{ route('pessoa.buscar-por-nome') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Remover animação de carregamento
                    cpfInput.classList.remove('animate-pulse');
                    
                    if (data.success) {
                        // Preencher o campo de CPF
                        cpfInput.value = data.pessoa.cpf;
                        nomeInput.value = data.pessoa.nome;
                        showAlert('Pessoa encontrada com sucesso!', 'success');
                    } else {
                        // Limpar o campo de CPF e exibir mensagem de erro
                        cpfInput.value = '';
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    // Remover animação de carregamento
                    cpfInput.classList.remove('animate-pulse');
                    
                    // Exibir mensagem de erro
                    cpfInput.value = '';
                    showAlert('Erro ao buscar a pessoa.', 'error');
                    console.error('Erro:', error);
                });
            } else {
                // Limpar o campo de CPF se o nome estiver vazio
                cpfInput.value = '';
            }
        });
        
        // Função para atualizar contadores
        function updateCounters() {
            const currentCount = document.querySelectorAll('#equipamentosAtuaisTable tr:not(#no-current-equipment)').length;
            const newCount = document.querySelectorAll('#equipamentosSelecionadosTable tr:not(#no-selected-equipment)').length;
            
            document.getElementById('current-equipment-count').textContent = currentCount;
            document.getElementById('new-equipment-count').textContent = newCount;
            
            // Mostrar/esconder mensagens de "nenhum equipamento"
            if (currentCount === 0) {
                document.getElementById('no-current-equipment').classList.remove('hidden');
            } else {
                document.getElementById('no-current-equipment').classList.add('hidden');
            }
            
            if (newCount === 0) {
                document.getElementById('no-selected-equipment').classList.remove('hidden');
            } else {
                document.getElementById('no-selected-equipment').classList.add('hidden');
            }
        }
        
        // Função para remover equipamento atual
        window.removerEquipamentoAtual = function(id) {
            const row = document.getElementById('equipamento-atual-' + id);
            if (row) {
                row.remove();
                updateCounters();
                showAlert('Equipamento removido com sucesso.', 'success');
            }
        };
        
        // Função para remover equipamento selecionado
        window.removerEquipamentoSelecionado = function(id) {
            const row = document.getElementById('equipamento-selecionado-' + id);
            if (row) {
                row.remove();
                updateCounters();
                showAlert('Equipamento removido da seleção.', 'success');
            }
        };
        
        // Função para adicionar equipamento à seleção
        window.adicionarEquipamento = function(id, tipo, numero_serie, modelo) {
            // Verificar se o equipamento já está na lista de selecionados
            if (document.getElementById('equipamento-selecionado-' + id)) {
                showAlert('Este equipamento já foi selecionado.', 'error');
                return;
            }
            
            // Remover a mensagem "nenhum equipamento selecionado" se estiver visível
            document.getElementById('no-selected-equipment').classList.add('hidden');
            
            // Criar a nova linha na tabela
            const newRow = document.createElement('tr');
            newRow.id = 'equipamento-selecionado-' + id;
            newRow.className = 'hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150';
            
            newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                    ${tipo}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                    ${numero_serie}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                    ${modelo}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                    <input type="hidden" name="equipamentos_novos[]" value="${id}">
                    <button type="button" onclick="removerEquipamentoSelecionado('${id}')"
                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                            class="mr-1">
                            <path d="M3 6h18" />
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                        </svg>
                        Remover
                    </button>
                </td>
            `;
            
            document.getElementById('equipamentosSelecionadosTable').appendChild(newRow);
            updateCounters();
            showAlert('Equipamento adicionado com sucesso.', 'success');
        };
        
        // Função para buscar equipamentos
        function buscarEquipamentos(page = 1) {
            const tipo_id = document.getElementById('tipo_id').value;
            const numero_serie = document.getElementById('numero_serie').value;
            const modelo = document.getElementById('modelo').value;
            
            // Mostrar indicador de carregamento
            document.getElementById('search-initial').classList.add('hidden');
            document.getElementById('search-empty').classList.add('hidden');
            document.getElementById('search-loading').classList.remove('hidden');
            
            // Limpar resultados anteriores
            const equipamentosNovosTable = document.getElementById('equipamentosNovosTable');
            const rows = equipamentosNovosTable.querySelectorAll('tr:not(#search-loading):not(#search-empty):not(#search-initial)');
            rows.forEach(row => row.remove());
            
            // Fazer a requisição AJAX
            fetch(`{{ route('equipamentos.search') }}?tipo_id=${tipo_id}&numero_serie=${numero_serie}&modelo=${modelo}&page=${page}`)
                .then(response => response.json())
                .then(response => {
                    // Esconder indicador de carregamento
                    document.getElementById('search-loading').classList.add('hidden');
                    
                    if (response.data.length === 0) {
                        // Mostrar mensagem de nenhum resultado
                        document.getElementById('search-empty').classList.remove('hidden');
                        document.getElementById('paginacao').innerHTML = '';
                        return;
                    }
                    
                    // Preencher a tabela com os resultados
                    response.data.forEach(equipamento => {
                        const row = document.createElement('tr');
                        row.id = 'resultado-' + equipamento.id;
                        row.className = 'hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150';
                        
                        row.innerHTML = `
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
                        `;
                        
                        equipamentosNovosTable.appendChild(row);
                    });
                    
                    // Construir a paginação
                    renderPagination(response.current_page, response.last_page);
                })
                .catch(error => {
                    console.error('Erro ao buscar equipamentos:', error);
                    document.getElementById('search-loading').classList.add('hidden');
                    showAlert('Erro ao buscar equipamentos. Tente novamente.', 'error');
                });
        }
        
        // Função para renderizar a paginação
        function renderPagination(currentPage, lastPage) {
            const paginacaoDiv = document.getElementById('paginacao');
            paginacaoDiv.innerHTML = '';
            
            if (lastPage <= 1) return;
            
            const ul = document.createElement('ul');
            ul.className = 'flex items-center -space-x-px h-8 text-sm';
            
            // Botão anterior
            const prevLi = document.createElement('li');
            prevLi.innerHTML = `
                <button type="button" onclick="buscarEquipamentos(${currentPage > 1 ? currentPage - 1 : 1})" 
                    class="${currentPage === 1 ? 'cursor-not-allowed opacity-50' : ''} flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </button>
            `;
            ul.appendChild(prevLi);
            
            // Páginas numeradas
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(lastPage, currentPage + 2);
            
            for (let i = startPage; i <= endPage; i++) {
                const pageLi = document.createElement('li');
                pageLi.innerHTML = `
                    <button type="button" onclick="buscarEquipamentos(${i})" 
                        class="${i === currentPage ? 'text-blue-600 bg-blue-50 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'} flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 hover:bg-gray-100 dark:border-gray-700">
                        ${i}
                    </button>
                `;
                ul.appendChild(pageLi);
            }
            
            // Botão próximo
            const nextLi = document.createElement('li');
            nextLi.innerHTML = `
                <button type="button" onclick="buscarEquipamentos(${currentPage < lastPage ? currentPage + 1 : lastPage})" 
                    class="${currentPage === lastPage ? 'cursor-not-allowed opacity-50' : ''} flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </button>
            `;
            ul.appendChild(nextLi);
            
            paginacaoDiv.appendChild(ul);
        }
        
        // Event listeners para busca de equipamentos
        document.getElementById('btnBuscarEquipamentos').addEventListener('click', function() {
            buscarEquipamentos(1);
        });
        
        // Também buscar equipamentos quando Enter for pressionado nos campos de busca
        document.getElementById('numero_serie').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                buscarEquipamentos(1);
            }
        });
        
        document.getElementById('modelo').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                buscarEquipamentos(1);
            }
        });
        
        // Inicializar contadores
        updateCounters();
        
        // Expor funções globalmente para uso nos botões
        window.buscarEquipamentos = buscarEquipamentos;
    });
</script>


