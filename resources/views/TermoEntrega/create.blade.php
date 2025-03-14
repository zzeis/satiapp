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
                                Nome
                                do Funcionário</label>
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

                    <div id="equipment-container" class="space-y-6">
                        <div
                            class="equipment-row p-5 border border-green-200 dark:border-green-700 rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <!-- Número de Série -->
                                <div class="group">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Número
                                        de Série</label>
                                    <input type="text" name=""
                                        class="serial-number block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                        placeholder="Digite o número de série">
                                </div>

                                <input type="hidden" name="equipamento_id[]" class="equipamento-id">

                                <!-- Tipo de Equipamento -->
                                <div class="group">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Tipo
                                        de Equipamento</label>
                                    <input type="text"
                                        class="equipment-type block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                        name="tipo_id[]" readonly>
                                </div>

                                <!-- Modelo -->
                                <div class="group">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Modelo</label>
                                    <input type="text"
                                        class="equipment-model block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                        name="modelo[]" readonly>
                                </div>
                            </div>

                            <!-- Botão Remover Equipamento -->
                            <div class="mt-4 flex justify-end">
                                <button type="button"
                                    class="remove-equipment-btn flex items-center bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 active:bg-red-700 transition-colors duration-200 shadow-sm hover:shadow"
                                    title="Remover equipamento">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-trash-2 mr-1">
                                        <path d="M3 6h18" />
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        <line x1="10" x2="10" y1="11" y2="17" />
                                        <line x1="14" x2="14" y1="11" y2="17" />
                                    </svg>
                                    Remover
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Botão Adicionar Outro Equipamento -->
                    <div class="mt-6 flex justify-center">
                        <button type="button" id="add-equipment-btn"
                            class="flex items-center bg-green-500 text-white px-5 py-2.5 rounded-lg hover:bg-green-600 active:bg-green-700 transition-colors duration-200 shadow-sm hover:shadow transform hover:scale-105 active:scale-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-package-plus mr-2">
                                <path d="M16 16h6" />
                                <path d="M19 13v6" />
                                <path
                                    d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                                <path d="m7.5 4.27 9 5.15" />
                                <polyline points="3.29 7 12 12 20.71 7" />
                                <line x1="12" x2="12" y1="22" y2="12" />
                            </svg>
                            Adicionar Equipamento
                        </button>
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

    <script>
        $(document).ready(function() {
            let equipmentCounter = 0;

            // Adicionar outro equipamento
            $('#add-equipment-btn').click(function() {
                equipmentCounter++;

                const newRow = `
                    <div class="equipment-row p-5 border border-green-200 dark:border-green-700 rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-shadow duration-300 transform translate-y-4 opacity-0" style="animation: fadeSlideIn 0.3s ease-out forwards;">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Número de Série -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Número de Série</label>
                                <input type="text" class="serial-number block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Digite o número de série">
                            </div>

                            <!-- id equipamento -->
                            <input type="hidden" name="equipamento_id[]" class="equipamento-id">
                            
                            <!-- Tipo de Equipamento -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Tipo de Equipamento</label>
                                <input type="text" class="equipment-type block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                    name="tipo_id[]" readonly>
                            </div>

                            <!-- Modelo -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">Modelo</label>
                                <input type="text" class="equipment-model block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-200 dark:text-gray-200"
                                    name="equipment_model[]" readonly>
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
            });

            // Remover equipamento
            $(document).on('click', '.remove-equipment-btn', function() {
                const row = $(this).closest('.equipment-row');

                // Animate removal
                row.css('animation', 'fadeSlideOut 0.3s ease-out forwards');

                // Remove after animation completes
                setTimeout(function() {
                    row.remove();
                }, 300);
            });

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

            // Buscar equipamento pelo número de série
            $(document).on('blur', '.serial-number', function() {
                const serialNumber = $(this).val();
                const row = $(this).closest('.equipment-row');

                if (serialNumber) {
                    // Add loading indicator
                    row.find('.equipment-type').val('Carregando...').addClass('animate-pulse');
                    row.find('.equipment-model').val('Carregando...').addClass('animate-pulse');

                    $.ajax({
                        url: '{{ route('equipamento.buscar-por-serial') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            serial_number: serialNumber
                        },
                        success: function(response) {
                            // Remove loading animation
                            row.find('.equipment-type, .equipment-model').removeClass(
                                'animate-pulse');

                            if (response.equipamento) {
                                // Preenche os campos com os dados do equipamento
                                row.find('.equipment-type').val(response.equipamento.tipo.nome);
                                row.find('.equipamento-id').val(response.equipamento.id);
                                row.find('.equipment-brand').val(response.equipamento.marca);
                                row.find('.equipment-model').val(response.equipamento.modelo);

                                // Flash success highlight
                                row.addClass('ring-2 ring-green-500/30');
                                setTimeout(function() {
                                    row.removeClass('ring-2 ring-green-500/30');
                                }, 1000);

                                showAlert('Equipamento encontrado com sucesso!', 'success');
                            } else {
                                // Clear the fields
                                row.find('.equipment-type').val('');
                                row.find('.equipment-model').val('');

                                // Exibe mensagem de erro com base no status
                                if (response.status) {
                                    showAlert(
                                        `Equipamento já está em uso. Status: ${response.status}`,
                                        'error');
                                } else {
                                    showAlert(response.message || 'Equipamento não encontrado.',
                                        'error');
                                }
                                row.find('.serial-number').val(
                                    ''); // Limpa o campo de número de série

                                // Flash error highlight
                                row.addClass('ring-2 ring-red-500/30');
                                setTimeout(function() {
                                    row.removeClass('ring-2 ring-red-500/30');
                                }, 1000);
                            }
                        },
                        error: function() {
                            // Remove loading animation
                            row.find('.equipment-type, .equipment-model').removeClass(
                                'animate-pulse');

                            showAlert('Erro ao buscar o equipamento.', 'error');

                            // Clear fields
                            row.find('.equipment-type').val('');
                            row.find('.equipment-model').val('');
                        }
                    });
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


            //funcao buscar nome 
            $(document).ready(function() {
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
                                    showAlert('Pessoa encontrada com sucesso!',
                                        'success');
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
            });
        });
    </script>

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
    </style>
@endsection