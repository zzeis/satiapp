@extends('layouts.app')
@section('title', 'Manutenções')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <!-- Header with Title and Action Button -->
            <div
                class="flex flex-col md:flex-row justify-between items-center p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400">
                        <path
                            d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Manutenções</h1>
                </div>
                <a href="{{ route('manutencao.create') }}"
                    class="mt-4 md:mt-0 inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:translate-y-[-1px] active:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Abrir Chamado
                </a>
            </div>

            <!-- Filtros e Pesquisa -->
            <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                <form action="{{ route('manutencao.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Filtro por Status -->
                        <div class="group">
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Status
                            </label>
                            <div class="relative">
                                <select name="status" id="status"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todos</option>
                                    <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto
                                    </option>
                                    <option value="em_andamento"
                                        {{ request('status') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="concluido" {{ request('status') == 'concluido' ? 'selected' : '' }}>
                                        Concluído</option>
                                    <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>
                                        Cancelado</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Pesquisa por Número de Série -->
                        <div class="group">
                            <label for="numero_serie"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Número de Série
                            </label>
                            <div class="relative">
                                <input type="text" name="numero_serie" id="numero_serie"
                                    class="block w-full px-4 py-3 pl-10 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Buscar por número de série" value="{{ request('numero_serie') }}">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-2">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path
                        d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                </svg>
                <span>Exibindo <span class="font-medium text-gray-800 dark:text-gray-200">{{ $manutencoes->count() }}</span>
                    de <span class="font-medium text-gray-800 dark:text-gray-200">{{ $manutencoes->total() }}</span>
                    manutenções</span>
            </div>

            <!-- Tabela de Manutenções -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Número de Série
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Modelo
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Data de Abertura
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($manutencoes as $manutencao)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('manutencao.informacoes', $manutencao->id) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors duration-200">
                                        @if ($manutencao->equipamento)
                                            {{ $manutencao->equipamento->numero_serie }}
                                        @elseif ($manutencao->equipamento_novo_id && $manutencao->equipamentoNovo)
                                            {{ $manutencao->equipamentoNovo->numero_serie }}
                                            <span class="text-xs text-gray-500 dark:text-gray-400 block">(substituiu
                                                {{ json_decode($manutencao->dados_equipamento_antigo)->numero_serie }})</span>
                                        @elseif ($manutencao->dados_equipamento_antigo)
                                            {{ json_decode($manutencao->dados_equipamento_antigo)->numero_serie }}
                                            <span class="text-xs text-gray-500 dark:text-gray-400 block">(equipamento
                                                substituído)</span>
                                        @else
                                            <span class="text-red-500 dark:text-red-400">Equipamento indisponível</span>
                                        @endif
                                    </a>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 dark:text-gray-300">
                                    @if ($manutencao->equipamento)
                                        {{ $manutencao->equipamento->modelo }}
                                    @elseif ($manutencao->equipamento_novo_id && $manutencao->equipamentoNovo)
                                        {{ $manutencao->equipamentoNovo->modelo }}
                                    @elseif ($manutencao->dados_equipamento_antigo)
                                        {{ json_decode($manutencao->dados_equipamento_antigo)->modelo }}
                                        <span class="text-xs text-gray-500 dark:text-gray-400 block">(equipamento
                                            substituído)</span>
                                    @else
                                        <span class="text-red-500 dark:text-red-400">Equipamento indisponível</span>
                                    @endif
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 dark:text-gray-300">
                                    @if ($manutencao->equipamento)
                                        {{ $manutencao->equipamento->tipo->nome }}
                                    @elseif ($manutencao->equipamento_novo_id && $manutencao->equipamentoNovo)
                                        {{ $manutencao->equipamentoNovo->tipo->nome }}
                                    @elseif ($manutencao->dados_equipamento_antigo)
                                        {{ json_decode($manutencao->dados_equipamento_antigo)->tipo_nome }}
                                        <span class="text-xs text-gray-500 dark:text-gray-400 block">(equipamento
                                            substituído)</span>
                                    @else
                                        <span class="text-red-500 dark:text-red-400">Equipamento indisponível</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClasses = [
                                            'em_andamento' =>
                                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                            'concluido' =>
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                            'aberto' =>
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                            'cancelado' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                        ];
                                        $statusTexts = [
                                            'aberto' => 'Aberto',
                                            'em_andamento' => 'Em Manutenção',
                                            'concluido' => 'Concluído',
                                            'cancelado' => 'Cancelado',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$manutencao->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $statusTexts[$manutencao->status] ?? $manutencao->status }}
                                    </span>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex flex-wrap items-center justify-center gap-2">
                                        <!-- Botão Gerenciar Manutenção -->
                                        @if ($manutencao->status == 'concluido')
                                            <a href="{{ route('manutencao.informacoes', $manutencao->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 rounded-md hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors duration-200"
                                                title="Ver informações">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="mr-1">
                                                    <rect width="18" height="18" x="3" y="3" rx="2"
                                                        ry="2" />
                                                    <line x1="8" x2="16" y1="10" y2="10" />
                                                    <line x1="8" x2="14" y1="14" y2="14" />
                                                    <line x1="8" x2="10" y1="18" y2="18" />
                                                </svg>
                                                Detalhes
                                            </a>
                                        @endif

                                        @if ($manutencao->status == 'em_andamento' || $manutencao->status == 'aberto')
                                            <button onclick="openManageModal('{{ $manutencao->id }}')"
                                                class="inline-flex items-center px-3 py-1.5 bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-200 rounded-md hover:bg-purple-200 dark:hover:bg-purple-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="mr-1">
                                                    <path d="M12 20h9" />
                                                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                                </svg>
                                                Gerenciar
                                            </button>
                                        @endif

                                        <!-- Botão Registrar Retirada -->
                                        @if ($manutencao->status == 'aberto')
                                            <form action="{{ route('manutencao.retirar', $manutencao->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="local" value="Local de retirada">
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200 rounded-md hover:bg-yellow-200 dark:hover:bg-yellow-800 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-1">
                                                        <path d="M5 8h14" />
                                                        <path d="M5 12h14" />
                                                        <path d="M5 16h14" />
                                                        <path d="M3 21h18" />
                                                        <path d="M9 3v18" />
                                                        <path d="M15 3v18" />
                                                    </svg>
                                                    Retirar
                                                </button>
                                            </form>
                                        @endif

                                        @if ($manutencao->status == 'aberto' || $manutencao->status == 'em_andamento')
                                            <button type="button"
                                                onclick="openConfirmCancelModal('{{ $manutencao->id }}')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 rounded-md hover:bg-red-200 dark:hover:bg-red-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="mr-1">
                                                    <path d="M18 6 6 18" />
                                                    <path d="m6 6 12 12" />
                                                </svg>
                                                Cancelar
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                {{ $manutencoes->links() }}
            </div>
        </div>
    </div>
    <!-- Modal de Confirmação para Cancelar Manutenção -->
    <div id="confirmCancelModal"
        class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-red-500 dark:text-red-400 mr-2">
                        <path d="M10 3 6 21" />
                        <path d="M18 3l-4 18" />
                        <path d="M4 8h16" />
                        <path d="M3 3h18v18H3z" />
                    </svg>
                    Confirmar Cancelamento
                </h2>
                <button type="button" onclick="closeConfirmCancelModal()"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-gray-700 dark:text-gray-300 mb-6">
                Tem certeza de que deseja cancelar esta manutenção? Esta ação não pode ser desfeita.
            </p>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeConfirmCancelModal()"
                    class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                    Voltar
                </button>
                <form id="cancelForm" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelado">
                    <button type="submit"
                        class="px-4 py-2.5 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors duration-200 shadow-sm hover:shadow">
                        Confirmar Cancelamento
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Gerenciar Manutenção -->
    <div id="manageModal"
        class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-md max-h-[80vh] overflow-y-auto mx-4 transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                    </svg>
                    Gerenciar Manutenção
                </h2>
                <button type="button" onclick="closeManageModal()"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <form id="manageForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <!-- Campos para exibir informações -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Local</label>
                        <p id="local" class="mt-1 text-gray-900 dark:text-gray-200 font-medium"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de
                            Equipamento</label>
                        <p id="tipo_equipamento" class="mt-1 text-gray-900 dark:text-gray-200 font-medium"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Descrição do
                            Defeito</label>
                        <p id="descricao_defeito" class="mt-1 text-gray-900 dark:text-gray-200 font-medium"></p>
                    </div>
                </div>

                <!-- Campos para ações -->
                <div class="group">
                    <label for="action"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Ação
                    </label>
                    <div class="relative">
                        <select name="action" id="action"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                            <option value="concerto">Concluído</option>
                            <option value="troca">Troca</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Campos para troca (inicialmente ocultos) -->
                <div id="trocaFields"
                    class="hidden space-y-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                    <div class="group">
                        <label for="novo_modelo"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            Modelo do Novo Equipamento
                        </label>
                        <input type="text" name="modelo" id="novo_modelo"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div class="group">
                        <label for="numero_serie"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            Número de Série do Novo Equipamento
                        </label>
                        <input type="text" name="numero_serie" id="novo_numero_serie"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div class="group">
                        <label for="novo_tipo"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            Tipo do Novo Equipamento
                        </label>
                        <input type="text" name="tipo_novo" id="novo_tipo"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-600 focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:text-gray-200"
                            readonly>
                    </div>
                </div>

                <div class="group">
                    <label for="observacoes"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Observações
                    </label>
                    <textarea name="observacoes" id="observacoes"
                        class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                        rows="3" placeholder="Descreva as observações sobre a manutenção"></textarea>
                </div>

                <!-- Campo oculto para enviar o status -->
                <input type="hidden" name="status" id="status_" value="">

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeManageModal()"
                        class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-sm hover:shadow">
                        Salvar Alterações
                    </button>
                </div>
            </form>
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

    <script>
        // Global variables
        let manutencaoId;
        let currentPropertyType = '';

        // Function to open the management modal
        function openManageModal(id) {
            manutencaoId = id;

            // Show modal with animation
            const modal = document.getElementById('manageModal');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Animate modal appearance
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);

            // Reset form fields
            document.getElementById('manageForm').reset();
            document.getElementById('trocaFields').classList.add('hidden');

            // Reset the action select
            const actionSelect = document.getElementById('action');
            actionSelect.innerHTML = '';

            // Add default options
            const concertoOption = document.createElement('option');
            concertoOption.value = 'concerto';
            concertoOption.textContent = 'Concluído';
            actionSelect.appendChild(concertoOption);

            // Fetch maintenance details
            fetch(`/manutencao/${manutencaoId}/detalhes`)
                .then(response => response.json())
                .then(data => {
                    // Fill the modal fields with the returned data
                    document.getElementById('local').textContent = data.local;
                    document.getElementById('tipo_equipamento').textContent = data.tipo_equipamento;
                    document.getElementById('descricao_defeito').textContent = data.descricao_defeito;
                    document.getElementById('novo_tipo').value = data.tipo_equipamento;

                    // Store the property type for later use
                    currentPropertyType = data.tipo_propriedade;

                    // Configure action options based on property type
                    if (data.tipo_propriedade === 'municipal') {
                        // Add the "Baixa" option
                        const baixaOption = document.createElement('option');
                        baixaOption.value = 'baixa';
                        baixaOption.textContent = 'Baixa de patrimônio';
                        actionSelect.appendChild(baixaOption);
                    } else {
                        // Add the "Troca" option for non-municipal equipment
                        const trocaOption = document.createElement('option');
                        trocaOption.value = 'troca';
                        trocaOption.textContent = 'Troca';
                        actionSelect.appendChild(trocaOption);
                    }

                    // Set initial form action and status
                    updateFormBasedOnAction('concerto');
                })
                .catch(error => {
                    console.error('Erro ao buscar detalhes da manutenção:', error);
                });
        }

        // Function to update form based on selected action
        function updateFormBasedOnAction(action) {
            const trocaFields = document.getElementById('trocaFields');
            const statusField = document.getElementById('status_');

            // Set form action and status based on the selected action
            if (action === 'troca') {
                trocaFields.classList.remove('hidden');
                statusField.value = 'concluido';
                document.getElementById('manageForm').action = `/manutencao/${manutencaoId}/trocar`;
            } else if (action === 'concerto') {
                trocaFields.classList.add('hidden');
                statusField.value = 'concluido';
                document.getElementById('manageForm').action = `/manutencao/${manutencaoId}/concluir`;
            } else if (action === 'baixa') {
                trocaFields.classList.add('hidden');
                statusField.value = 'baixa';
                document.getElementById('manageForm').action = `/manutencao/${manutencaoId}/concluir`;
            }

            console.log('Action:', action, 'Status:', statusField.value);
        }

        // Function to close the management modal
        function closeManageModal() {
            const modal = document.getElementById('manageModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        // Function to open the confirmation modal
        function openConfirmCancelModal(id) {
            manutencaoId = id;
            const modal = document.getElementById('confirmCancelModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('cancelForm').action = `/manutencao/${manutencaoId}/destroy`;
        }

        // Function to close the confirmation modal
        function closeConfirmCancelModal() {
            const modal = document.getElementById('confirmCancelModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for changes on the action select
            document.getElementById('action').addEventListener('change', function() {
                updateFormBasedOnAction(this.value);
            });

            // Close modals when clicking outside
            document.getElementById('manageModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeManageModal();
                }
            });

            document.getElementById('confirmCancelModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeConfirmCancelModal();
                }
            });
        });
    </script>
@endsection
