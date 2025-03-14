@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <!-- Header with Title -->
            <div class="border-b border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-3">
                        <path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Cadastrar Equipamento</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Preencha os dados para registrar um novo equipamento no sistema</p>
            </div>

            <!-- Mensagens de Erro -->
            @if ($errors->any())
                <div class="mx-6 mt-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    <div class="flex items-center mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" x2="12" y1="8" y2="12" />
                            <line x1="12" x2="12.01" y1="16" y2="16" />
                        </svg>
                        <span class="font-medium">Por favor, corrija os seguintes erros:</span>
                    </div>
                    <ul class="list-disc list-inside ml-6 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="mx-6 mt-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Formulário -->
            <form action="{{ route('equipamentos.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Coluna 1: Informações do Equipamento -->
                    <div class="space-y-6">
                        <!-- Número de Série -->
                        <div class="group">
                            <label for="numero_serie" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-2">
                                    <path d="M4 7V4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H6a2 2 0 0 0-2 2v3" />
                                    <path d="M2 14h12" />
                                    <path d="m9 18 3-3-3-3" />
                                </svg>
                                Número de Série
                            </label>
                            <input type="text" name="numero_serie" id="numero_serie"
                                class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                placeholder="Digite o número de série" required>
                        </div>

                        <!-- Modelo -->
                        <div class="group">
                            <label for="modelo" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-2">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                    <line x1="3" x2="21" y1="9" y2="9" />
                                    <line x1="3" x2="21" y1="15" y2="15" />
                                    <line x1="9" x2="9" y1="3" y2="21" />
                                    <line x1="15" x2="15" y1="3" y2="21" />
                                </svg>
                                Modelo
                            </label>
                            <input type="text" name="modelo" id="modelo"
                                class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                placeholder="Digite o modelo do equipamento" required>
                        </div>
                    </div>

                    <!-- Coluna 2: Tipo e Data -->
                    <div class="space-y-6">
                        <!-- Tipo de Equipamento -->
                        <div class="group">
                            <label for="tipo_equipamento_id" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-2">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                                </svg>
                                Tipo de Equipamento
                            </label>
                            <div class="relative">
                                <select name="tipo_id" id="tipo_equipamento_id"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none"
                                    required>
                                    <option value="">Selecione um tipo</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Data de Chegada -->
                        <div class="group">
                            <label for="data_chegada" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-2">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                    <line x1="16" x2="16" y1="2" y2="6" />
                                    <line x1="8" x2="8" y1="2" y2="6" />
                                    <line x1="3" x2="21" y1="10" y2="10" />
                                </svg>
                                Data de Chegada
                            </label>
                            <input type="date" name="data_chegada" id="data_chegada"
                                class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Hidden input for SATI secretaria ID -->
                <input type="hidden" name="sati_secretaria_id" value="9">

                <!-- Botões de Ação -->
                <div class="mt-8 flex justify-between items-center  pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('equipamentos.index') }}"
                        class="flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Voltar 
                    </a>

                    <button type="submit"
                        class="flex items-center w-full max-w-[16rem] bg-blue-600 text-white px-4 sm:px-6 py-3 rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:translate-y-[-2px] active:translate-y-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Cadastrar Equipamento
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelect = document.getElementById('status');
                const responsavelContainer = document.getElementById('responsavel_container');
                const dataSaidaContainer = document.getElementById('data_saida_container');
                const secretariaSelect = document.getElementById('secretaria_id');
                const satiSecretariaId = "9"; // ID da secretaria SATI

                // Check if elements exist before adding event listeners
                if (statusSelect) {
                    function handleStatusChange() {
                        const isEstoque = statusSelect.value === 'estoque';

                        // Show/hide responsável and data de saída if elements exist
                        if (responsavelContainer) {
                            responsavelContainer.style.display = isEstoque ? 'none' : 'block';
                        }
                        
                        if (dataSaidaContainer) {
                            dataSaidaContainer.style.display = isEstoque ? 'none' : 'block';
                        }

                        // Set secretaria to SATI when status is estoque
                        if (secretariaSelect && isEstoque) {
                            secretariaSelect.value = satiSecretariaId;
                        } else if (secretariaSelect) {
                            secretariaSelect.disabled = false;
                        }
                    }

                    // Initial check
                    handleStatusChange();

                    // Listen for changes
                    statusSelect.addEventListener('change', handleStatusChange);
                }
            });
        </script>
    @endpush
@endsection