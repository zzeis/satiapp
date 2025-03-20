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

        <!-- Informações do Equipamento -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="border-b border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-3">
                        <path
                            d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Informações do Equipamento</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Detalhes completos do equipamento e seu histórico</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-600 hover:shadow-md transition-shadow duration-300">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Número de
                            Série</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $equipamento->numero_serie }}
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-600 hover:shadow-md transition-shadow duration-300">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Modelo</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $equipamento->modelo }}</p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-600 hover:shadow-md transition-shadow duration-300">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tipo</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $equipamento->tipo->nome }}</p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-600 hover:shadow-md transition-shadow duration-300">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Propriedade</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            @if ($equipamento->tipo_propriedade == 'municipal')
                                Patrimônio Municipal
                            @elseif ($equipamento->tipo_propriedade == 'alugado')
                                Alugado
                            @else
                                {{ ucfirst($equipamento->tipo_propriedade) }}
                            @endif
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-600 hover:shadow-md transition-shadow duration-300">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Responsável</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $equipamento->responsavel->nome ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manutenções -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="border-b border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-3">
                        <path
                            d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Manutenções</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Histórico de manutenções realizadas neste equipamento
                </p>
            </div>

            <div class="p-6">
                @if ($equipamento->manutencoes->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
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
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Data de Abertura
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Descrição do Problema
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aberto por
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($equipamento->manutencoes as $manutencao)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
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
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$manutencao->status] }}">
                                                {{ $statusTexts[$manutencao->status] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $manutencao->descricao_problema }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $manutencao->user->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Movimentações -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-3">
                        <path d="m18 8 4 4-4 4" />
                        <path d="m2 12 3-3 3 3-3 3-3-3Z" />
                        <path d="M18 12H6" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Movimentações</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Histórico de movimentações deste equipamento</p>
            </div>

            <div class="p-6">
                @if ($equipamento->movimentacoes->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
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
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Ação
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Descrição
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($equipamento->movimentacoes as $movimentacao)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $movimentacao->acao }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $movimentacao->descricao }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
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
