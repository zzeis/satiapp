@extends('layouts.app')

@section('title', 'Detalhes da Manutenção')

@section('content')
    <div class="container mx-auto px-4 py-8">

       
        <!-- Header with Actions -->

        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="flex items-center mb-4 sm:mb-0">
                <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-600 dark:text-blue-400">
                        <path
                            d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                    </svg>
                </div>
                <div>
                    
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Manutenção #{{ $manutencao->id }}
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Aberto em {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            
            <div class="flex space-x-3">
                <a href="{{ route('manutencao.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Voltar
                </a>


            </div>
        </div>

        <x-anotacoes :model="$manutencao" tipo="manutencao"/>

        
        <!-- Status Badge -->
        <div class="mb-8">
            @php
                $statusClasses = [
                    'aberto' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                    'em_andamento' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                    'concluido' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                    'cancelado' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                ];

                $statusLabels = [
                    'aberto' => 'Aberto',
                    'em_andamento' => 'Em Andamento',
                    'concluido' => 'Concluído',
                    'cancelado' => 'Cancelado',
                ];

                $statusClass =
                    $statusClasses[$manutencao->status] ??
                    'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                $statusLabel = $statusLabels[$manutencao->status] ?? ucfirst($manutencao->status);
            @endphp

            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                <span
                    class="w-2 h-2 rounded-full mr-2 {{ str_replace('text', 'bg', explode(' ', $statusClass)[1]) }}"></span>
                {{ $statusLabel }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <!-- Informações da Manutenção -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                <path
                                    d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Detalhes da Manutenção</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Descrição do Problema
                                </h3>
                                <p class="text-gray-800 dark:text-gray-200 bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                    {{ $manutencao->descricao_problema ?: 'Não informado' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Observações</h3>
                                <p class="text-gray-800 dark:text-gray-200 bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                    {{ $manutencao->observacoes ?: 'Não informado' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Local Especificado
                                </h3>
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $manutencao->local ?: 'Não informado' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Aberto por</h3>
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-2">
                                        <span class="text-blue-600 dark:text-blue-400 text-sm font-medium">
                                            {{ strtoupper(substr($manutencao->user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-gray-800 dark:text-gray-200">{{ $manutencao->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Movimentações -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                <path d="M3 12h4l3 8 4-16 3 8h4" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Histórico de Movimentações
                            </h2>
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($manutencao->movimentacoes->isEmpty())
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round" class="mx-auto mb-4 text-gray-400 dark:text-gray-600">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                    <line x1="8" x2="16" y1="12" y2="12" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Nenhuma movimentação registrada para esta
                                    manutenção.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Ação</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Descrição</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Data</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Usuário</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($manutencao->movimentacoes as $movimentacao)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-750">
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                    @php
                                                        $acaoIcons = [
                                                            'abertura' =>
                                                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 dark:text-green-400 mr-1"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>',
                                                            'atualizacao' =>
                                                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-1"><path d="M21 2v6h-6"/><path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M3 22v-6h6"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/></svg>',
                                                            'conclusao' =>
                                                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 dark:text-green-400 mr-1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                                                            'cancelamento' =>
                                                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 dark:text-red-400 mr-1"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
                                                        ];

                                                        $icon =
                                                            $acaoIcons[strtolower($movimentacao->acao)] ??
                                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 dark:text-gray-400 mr-1"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';
                                                    @endphp
                                                    <div class="flex items-center">
                                                        {!! $icon !!}
                                                        {{ $movimentacao->acao }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                    {{ $movimentacao->descricao }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                    {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i') }}
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-6 h-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-2">
                                                            <span
                                                                class="text-gray-600 dark:text-gray-400 text-xs font-medium">
                                                                {{ strtoupper(substr($movimentacao->user->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        {{ $movimentacao->user->name }}
                                                    </div>
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

            <div class="space-y-6">
                <!-- Informações do Equipamento -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                <line x1="8" x2="16" y1="21" y2="21" />
                                <line x1="12" x2="12" y1="17" y2="21" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Equipamento</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($manutencao->equipamento)
                            <div class="space-y-4">
                                <div class="flex items-center justify-center mb-4">
                                    <div
                                        class="w-20 h-20 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="text-blue-600 dark:text-blue-400">
                                            <rect width="20" height="14" x="2" y="3" rx="2" />
                                            <line x1="8" x2="16" y1="21" y2="21" />
                                            <line x1="12" x2="12" y1="17" y2="21" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="text-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ $manutencao->equipamento->modelo }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $manutencao->equipamento->tipo->nome }}</p>
                                </div>

                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <dl class="space-y-3">
                                        <div class="flex justify-between">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Número de
                                                Série</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $manutencao->equipamento->numero_serie }}</dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Propriedade
                                            </dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                @if ($manutencao->equipamento->tipo_propriedade == 'municipal')
                                                    Patrimônio Municipal
                                                @elseif ($manutencao->equipamento->tipo_propriedade == 'alugado')
                                                    Alugado
                                                @else
                                                    {{ ucfirst($manutencao->equipamento->tipo_propriedade) }}
                                                @endif
                                            </dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Responsável
                                            </dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $manutencao->equipamento->responsavel->nome ?? 'N/A' }}</dd>
                                        </div>

                                        <div class="flex justify-between gap-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Secretaria
                                            </dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $manutencao->equipamento->secretaria->nome ?? 'N/A' }}</dd>
                                        </div>
                                    </dl>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('equipamentos.detalhes', $manutencao->equipamento->id) }}"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        Ver Detalhes do Equipamento
                                    </a>
                                </div>

                            </div>
                        @elseif ($manutencao->equipamento_novo_id)
                            <div class="space-y-4">
                                <div class="flex items-center justify-center mb-4">
                                    <div
                                        class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="text-green-600 dark:text-green-400">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="text-center mb-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 mb-2">
                                        Substituído
                                    </span>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ $manutencao->equipamentoNovo->modelo }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $manutencao->equipamentoNovo->tipo->nome }}</p>
                                </div>

                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <dl class="space-y-3">
                                        <div class="flex justify-between">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Número de
                                                Série (Novo)</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $manutencao->equipamentoNovo->numero_serie }}</dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Equipamento
                                                Antigo</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ json_decode($manutencao->dados_equipamento_antigo)->numero_serie }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('equipamentos.show', $manutencao->equipamento_novo_id) }}"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        Ver Detalhes do Equipamento
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-6">
                                <div
                                    class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="text-red-600 dark:text-red-400">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" x2="12" y1="8" y2="12" />
                                        <line x1="12" x2="12.01" y1="16" y2="16" />
                                    </svg>
                                </div>
                                <p class="text-red-600 dark:text-red-400 font-medium">Equipamento indisponível</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">O equipamento associado a esta
                                    manutenção não está disponível.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informações Adicionais -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" x2="12" y1="8" y2="12" />
                                <line x1="12" x2="12.01" y1="16" y2="16" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Informações Adicionais</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID da Manutenção</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">#{{ $manutencao->id }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de Abertura</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($manutencao->created_at)->format('d/m/Y H:i') }}
                                </dd>
                            </div>

                            @if ($manutencao->data_conclusao)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de Conclusão</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($manutencao->data_conclusao)->format('d/m/Y H:i') }}
                                    </dd>
                                </div>
                            @endif

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tempo Total</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    @php
                                        $dataInicio = \Carbon\Carbon::parse($manutencao->created_at);
                                        $dataFim = $manutencao->data_conclusao
                                            ? \Carbon\Carbon::parse($manutencao->data_conclusao)
                                            : \Carbon\Carbon::now();
                                        $diff = $dataInicio->diff($dataFim);

                                        if ($diff->days > 0) {
                                            echo $diff->days . ' dia(s), ' . $diff->h . ' hora(s)';
                                        } else {
                                            echo $diff->h . ' hora(s), ' . $diff->i . ' minuto(s)';
                                        }
                                    @endphp
                                </dd>
                            </div>
                        </dl>
                    </div>
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
            background-color: rgba(55, 65, 81, 0.5);
        }
    </style>
@endsection
