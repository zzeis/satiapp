@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Botão Voltar -->
        <a href="{{ route('equipamentos.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors duration-300 mb-6 shadow-sm hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
            Voltar
        </a>


        <x-anotacoes :model="$equipamento" tipo="equipamento" />

        <!-- Informações do Equipamento - Card Compacto -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="border-b border-gray-100 dark:border-gray-700 p-4">
                <div class="flex items-center mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-2">
                        <path
                            d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                    </svg>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Informações do Equipamento</h2>
                </div>
            </div>

            <div class="p-4">
                <!-- Equipment Summary Card -->
                <div
                    class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-4 border border-blue-100 dark:border-blue-800/30">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-800/50 p-3 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-600 dark:text-blue-300">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                <path d="M16 2v5" />
                                <path d="M8 2v5" />
                                <path d="M12 14v3" />
                                <path d="M2 10h20" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $equipamento->tipo->nome }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Modelo: {{ $equipamento->modelo }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">N/s: {{ $equipamento->numero_serie }}</p>
                        </div>
                    </div>
                </div>

                <!-- Equipment Details Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Número de Série</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $equipamento->numero_serie }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Propriedade</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            @if ($equipamento->tipo_propriedade == 'municipal')
                                Patrimônio Municipal
                            @elseif ($equipamento->tipo_propriedade == 'alugado')
                                Alugado
                            @else
                                {{ ucfirst($equipamento->tipo_propriedade) }}
                            @endif
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Responsável</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            {{ $equipamento->responsavel->nome ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Data de Chegada</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            {{ $equipamento->data_chegada ? $equipamento->data_chegada->format('d/m/Y') : 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cadastrado em</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            {{ $equipamento->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</p>
                        <p class="text-sm font-semibold">
                            @if ($equipamento->responsavel)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Em uso
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    Em estoque
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cadastrado por</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            {{ $equipamento->user->name ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Última atualização</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            {{ $equipamento->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>


                </div>
            </div>
        </div>

        <!-- Tabs for Manutenções and Movimentações -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex -mb-px" aria-label="Tabs">
                    <button onclick="switchTab('manutencoes')" id="tab-manutencoes"
                        class="tab-button text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="inline-block mr-2">
                            <path
                                d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                        </svg>
                        Manutenções
                    </button>
                    <button onclick="switchTab('movimentacoes')" id="tab-movimentacoes"
                        class="tab-button text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-300 whitespace-nowrap py-4 px-6 border-b-2 border-transparent font-medium text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="inline-block mr-2">
                            <path d="m18 8 4 4-4 4" />
                            <path d="m2 12 3-3 3 3-3 3-3-3Z" />
                            <path d="M18 12H6" />
                        </svg>
                        Movimentações
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div id="tab-content-manutencoes" class="tab-content p-4">
                @if ($equipamento->manutencoes->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="text-gray-400 dark:text-gray-500 mb-4">
                            <path
                                d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Nenhuma manutenção registrada para este
                            equipamento.</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">As manutenções realizadas serão exibidas
                            aqui.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Problema
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($equipamento->manutencoes as $manutencao)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @php
                                                $statusClasses = [
                                                    'aberto' =>
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                    'em_andamento' =>
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                    'concluido' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                    'cancelado' =>
                                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                                ];
                                                $statusTexts = [
                                                    'aberto' => 'Aberto',
                                                    'em_andamento' => 'Em Andamento',
                                                    'concluido' => 'Concluído',
                                                    'cancelado' => 'Cancelado',
                                                ];
                                            @endphp
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$manutencao->status] }}">
                                                {{ $statusTexts[$manutencao->status] }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate">
                                            {{ $manutencao->descricao_problema }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $manutencao->user->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div id="tab-content-movimentacoes" class="tab-content p-4 hidden">
                @if ($equipamento->movimentacoes->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="text-gray-400 dark:text-gray-500 mb-4">
                            <path d="m18 8 4 4-4 4" />
                            <path d="m2 12 3-3 3 3-3 3-3-3Z" />
                            <path d="M18 12H6" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Nenhuma movimentação registrada para este
                            equipamento.</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">As movimentações realizadas serão exibidas
                            aqui.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Ação
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Descrição
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($equipamento->movimentacoes as $movimentacao)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                                            @php
                                                $actionClasses = match (strtolower($movimentacao->acao)) {
                                                    'atribuído',
                                                    'atribuido'
                                                        => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                    'removido'
                                                        => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                                    default
                                                        => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                };
                                            @endphp
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $actionClasses }}">
                                                {{ $movimentacao->acao }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate">
                                            {{ $movimentacao->descricao }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $movimentacao->user->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal para editar anotação -->
        <div id="modal-edit-anotacao"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Editar Anotação</h3>
                    <form id="edit-anotacao-form" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="edit-anotacao-text"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anotação</label>
                            <textarea id="edit-anotacao-text" name="anotacao" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                onclick="document.getElementById('modal-edit-anotacao').classList.add('hidden')"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-300">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-300">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para adicionar anotação -->
        <div id="modal-anotacao"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Adicionar Anotação</h3>
                    <form action="{{ route('anotacoes.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_equipamento" value="{{ $equipamento->id }}">

                        <div class="mb-4">
                            <label for="anotacao"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anotação</label>
                            <textarea id="anotacao" name="anotacao" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                onclick="document.getElementById('modal-anotacao').classList.add('hidden')"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-300">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-300">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
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

        /* Handwriting font for post-it notes */
        .font-handwriting {
            font-family: 'Comic Sans MS', 'Segoe Print', 'Bradley Hand', cursive;
        }
    </style>

    <script>
        function openEditModal(id, text) {
            const form = document.getElementById('edit-anotacao-form');
            form.action = `/anotacoes/${id}`;
            document.getElementById('edit-anotacao-text').value = text;
            document.getElementById('modal-edit-anotacao').classList.remove('hidden');
        }

        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show the selected tab content
            document.getElementById(`tab-content-${tabName}`).classList.remove('hidden');

            // Update tab button styles
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-blue-600', 'border-blue-600', 'dark:text-blue-400',
                    'dark:border-blue-400');
                button.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300',
                    'dark:text-gray-400', 'dark:hover:text-gray-300', 'dark:hover:border-gray-300',
                    'border-transparent');
            });

            // Highlight the active tab
            const activeTab = document.getElementById(`tab-${tabName}`);
            activeTab.classList.remove('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300',
                'dark:text-gray-400', 'dark:hover:text-gray-300', 'dark:hover:border-gray-300', 'border-transparent');
            activeTab.classList.add('text-blue-600', 'border-blue-600', 'dark:text-blue-400', 'dark:border-blue-400');
        }
    </script>
@endsection
