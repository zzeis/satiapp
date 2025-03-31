@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div
            class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300">
            <!-- Cabeçalho -->

            
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-white">
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                            <path d="M9 9h1" />
                            <path d="M9 13h6" />
                            <path d="M9 17h6" />
                        </svg>
                        <h3 class="text-2xl font-bold text-white">Termo de Entrega #{{ $termoEntrega->id }}</h3>
                    </div>
                    <div class="hidden sm:block">
                        @if ($termoEntrega->status)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1.5">
                                    <path d="M20 6 9 17l-5-5" />
                                </svg>
                                Ativo
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1.5">
                                    <path d="m5 12 5 5 9-9" />
                                </svg>
                                Devolvido
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <x-anotacoes :model="$termoEntrega" tipo="termoEntrega" />
            <!-- Corpo do Card -->
            <div class="p-6 md:p-8">
                <!-- Dados do Responsável e do Termo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- Dados do Responsável -->
                    <div
                        class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Dados do Responsável</h4>
                        </div>
                        <div class="space-y-4 text-gray-600 dark:text-gray-300">
                            <div class="flex">
                                <span class="w-28 font-medium text-gray-700 dark:text-gray-300">Nome:</span>
                                <span>{{ $termoEntrega->responsavel->nome }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-28 font-medium text-gray-700 dark:text-gray-300">CPF:</span>
                                <span>{{ $termoEntrega->responsavel->cpf }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-28 font-medium text-gray-700 dark:text-gray-300">Secretaria:</span>
                                <span>{{ $termoEntrega->secretaria->nome }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dados do Termo -->
                    <div
                        class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <path d="M14 2v6h6" />
                                <path d="M16 13H8" />
                                <path d="M16 17H8" />
                                <path d="M10 9H8" />
                            </svg>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Dados do Termo</h4>
                        </div>
                        <div class="space-y-4 text-gray-600 dark:text-gray-300">
                            <div class="flex">
                                <span class="w-36 font-medium text-gray-700 dark:text-gray-300">Data de Criação:</span>
                                <span>{{ $termoEntrega->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-36 font-medium text-gray-700 dark:text-gray-300">Usuário Responsável:</span>
                                <span>{{ $termoEntrega->usuario->name }}</span>
                            </div>

                            <!-- Verificação dinâmica do processamento -->
                            <div id="processamento-status" class="flex">
                                <span class="w-36 font-medium text-gray-700 dark:text-gray-300">Arquivo:</span>
                                @if ($termoEntrega->processado)
                                    <a href="{{ asset($termoEntrega->arquivo_path) }}" target="_blank"
                                        class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 flex items-center">
                                        <span class="underline">Visualizar PDF</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="ml-1">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                                            <polyline points="15 3 21 3 21 9" />
                                            <line x1="10" y1="14" x2="21" y2="3" />
                                        </svg>
                                    </a>
                                @else
                                    <div class="flex items-center space-x-2">
                                        <div
                                            class="animate-spin h-5 w-5 border-t-2 border-b-2 border-blue-500 dark:border-blue-400 rounded-full">
                                        </div>
                                        <span class="text-gray-600 dark:text-gray-400">O PDF do termo está sendo
                                            processado...</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Equipamentos -->
                <div class="mb-10">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                            <path d="M16 2v5" />
                            <path d="M8 2v5" />
                            <path d="M12 14v3" />
                            <path d="M2 10h20" />
                        </svg>
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Equipamentos</h4>
                        <span
                            class="ml-2 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ count($termoEntrega->equipamentos) }}
                        </span>
                    </div>
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tipo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Modelo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Número de Série
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($termoEntrega->equipamentos as $equipamento)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                {{ $equipamento->tipo->nome }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                {{ $equipamento->modelo }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $equipamento->numero_serie }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3"
                                                class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 text-center">
                                                <div class="flex flex-col items-center justify-center py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="text-gray-400 mb-3">
                                                        <rect width="20" height="14" x="2" y="7" rx="2"
                                                            ry="2" />
                                                        <path d="M12 7v14" />
                                                        <path d="M2 14h20" />
                                                    </svg>
                                                    <p>Nenhum equipamento encontrado para este termo.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Devolução -->
                @if ($termoEntrega->observacoes && $termoEntrega->status == false)
                    <div
                        class="mb-10 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800/30 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-yellow-600 dark:text-yellow-500 mr-2">
                                <path
                                    d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Informações de Devolução
                            </h4>
                        </div>
                        <div class="space-y-4 text-gray-600 dark:text-gray-300">
                            <div class="flex">
                                <span class="w-40 font-medium text-gray-700 dark:text-gray-300">Data de devolução:</span>
                                <span>{{ \Carbon\Carbon::parse($termoEntrega->data_devolucao)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-40 font-medium text-gray-700 dark:text-gray-300">Usuário Responsável:</span>
                                <span>{{ $termoEntrega->usuarioDevolucao ? $termoEntrega->usuarioDevolucao->name : 'N/A' }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700 dark:text-gray-300 mb-2">Observações:</p>
                                <p
                                    class="bg-white dark:bg-gray-800 p-3 rounded border border-gray-200 dark:border-gray-700">
                                    {{ $termoEntrega->observacoes }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Botões de Ação -->
                <div
                    class="flex flex-wrap justify-between items-center mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('termo.index') }}"
                        class="flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200 mb-2 sm:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Voltar
                    </a>

                    <div class="flex space-x-3">
                        <a href="{{ route('termo.edit', $termoEntrega->id) }} "
                            class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                            </svg>
                            Editar
                        </a>
                        @if ($termoEntrega->status)
                            <button onclick="openModal('{{ $termoEntrega->id }}')"
                                class="flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="m9 14-4-4 4-4" />
                                    <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                                </svg>
                                Registrar Devolução
                            </button>
                        @endif




                        @if ($termoEntrega->processado)
                            <a href="{{ asset($termoEntrega->arquivo_path) }}" target="_blank"
                                class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                    <path d="M16 13H8" />
                                    <path d="M16 17H8" />
                                    <path d="M10 9H8" />
                                </svg>
                                Ver PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Devolução -->
    <div id="modal-devolucao" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-md max-h-[80vh] overflow-y-auto mx-4 transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-yellow-500 dark:text-yellow-400 mr-2">
                        <path d="M9 14 4 9l5-5" />
                        <path d="M4 9h16" />
                        <path d="M15 4v6" />
                    </svg>
                    Registrar Devolução
                </h2>
                <button type="button" onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <form id="form-devolucao" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="termo_id" id="termo_id">

                <div class="group">
                    <label for="observacoes_devolucao"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Observações
                    </label>
                    <textarea name="observacoes_devolucao" id="observacoes_devolucao" rows="4"
                        class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                        placeholder="Digite as observações sobre a devolução"></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-sm hover:shadow">
                        Confirmar Devolução
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Print styles */
        @media print {
            body * {
                visibility: hidden;
            }

            .container,
            .container * {
                visibility: visible;
            }

            .container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            a[href]:after {
                content: none !important;
            }

            .no-print,
            .no-print * {
                display: none !important;
            }
        }

        /* Additional dark mode color for slightly lighter than gray-700 */
        .dark .dark\:bg-gray-750 {
            background-color: rgba(55, 65, 81, 0.5);
        }

        /* Hover effect for dark mode table rows */
        .dark .dark\:hover\:bg-gray-750:hover {
            background-color: rgba(55, 65, 81, 0.8);
        }
    </style>

    <!-- Script para verificação dinâmica do processamento -->
    <script>
        function verificarProcessamento() {
            fetch("{{ route('termo.verificar_processamento', $termoEntrega->id) }}")
                .then(response => response.json())
                .then(data => {
                    if (data.processado) {
                        // Atualiza o conteúdo da div com o link para o arquivo
                        document.getElementById('processamento-status').innerHTML = `
                            <span class="w-36 font-medium text-gray-700 dark:text-gray-300">Arquivo:</span>
                            <a href="${data.arquivo_path}" target="_blank"
                                class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 flex items-center">
                                <span class="underline">Visualizar PDF</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="ml-1">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                                    <polyline points="15 3 21 3 21 9" />
                                    <line x1="10" y1="14" x2="21" y2="3" />
                                </svg>
                            </a>
                        `;

                        // Adicionar botão de visualização de PDF se não existir
                        const actionButtons = document.querySelector('.flex.space-x-3');
                        if (actionButtons && !document.querySelector('a[href="' + data.arquivo_path + '"]')) {
                            const pdfButton = document.createElement('a');
                            pdfButton.href = data.arquivo_path;
                            pdfButton.target = '_blank';
                            pdfButton.className =
                                'flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200';
                            pdfButton.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="mr-2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                    <path d="M16 13H8" />
                                    <path d="M16 17H8" />
                                    <path d="M10 9H8" />
                                </svg>
                                Ver PDF
                            `;
                            actionButtons.appendChild(pdfButton);
                        }
                    } else {
                        // Continua verificando após 5 segundos
                        setTimeout(verificarProcessamento, 5000);
                    }
                })
                .catch(error => {
                    console.error('Erro ao verificar processamento:', error);
                    // Tenta novamente após 10 segundos em caso de erro
                    setTimeout(verificarProcessamento, 10000);
                });
        }

        // Inicia a verificação se o termo ainda não estiver processado
        @if (!$termoEntrega->processado)
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(verificarProcessamento, 5000);
            });
        @endif

        function openModal(termoId) {
            document.getElementById('form-devolucao').action = `/TermoDeEntrega/${termoId}/devolucao`;

            // Show modal with animation
            const modal = document.getElementById('modal-devolucao');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Animate modal appearance
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            // Animate modal disappearance
            const modal = document.getElementById('modal-devolucao');
            const modalContent = document.getElementById('modalContent');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        // Close modal when clicking outside
        document.getElementById('modal-devolucao').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });
    </script>
@endsection
