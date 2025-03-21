@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div
            class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300">
            <!-- Header -->
            <div class="bg-gradient-to-r from-yellow-500 to-amber-600 dark:from-yellow-600 dark:to-amber-700 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
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
                        <h3 class="text-2xl font-bold text-white">Detalhes da Movimentação</h3>
                    </div>

                    @php
                        $actionClasses = match (strtolower($movimentacao->acao)) {
                            'atribuído', 'atribuido' => 'bg-green-500/20 text-green-50',
                            'removido' => 'bg-red-500/20 text-red-50',
                            default => 'bg-blue-500/20 text-blue-50',
                        };
                    @endphp
                    <div class="{{ $actionClasses }} backdrop-blur-sm rounded-lg px-3 py-1.5 text-sm font-medium">
                        <span>{{ $movimentacao->acao }}</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Coluna da Esquerda - Informações Básicas -->
                    <div class="space-y-6">
                        <!-- Equipamento Card -->
                        <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-yellow-500 dark:text-yellow-400 mr-2">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                    <path d="M16 2v5" />
                                    <path d="M8 2v5" />
                                    <path d="M12 14v3" />
                                    <path d="M2 10h20" />
                                </svg>
                                Informações do Equipamento
                            </h4>

                            <a href="{{ route('equipamentos.detalhes', $movimentacao->equipamento->id) }}">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="flex-shrink-0 h-16 w-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="text-gray-600 dark:text-gray-300">
                                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                            <path d="M16 2v5" />
                                            <path d="M8 2v5" />
                                            <path d="M12 14v3" />
                                            <path d="M2 10h20" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $movimentacao->equipamento->tipo->nome }}</h5>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Responsável: {{ $movimentacao->equipamento->responsavel->nome ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Número de Série</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                        {{ $movimentacao->equipamento->numero_serie ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Modelo</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                        {{ $movimentacao->equipamento->modelo ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Ação e Usuário Card -->
                        <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-blue-500 dark:text-blue-400 mr-2">
                                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                                    <path d="m7 10 3 3 7-7" />
                                </svg>
                                Detalhes da Ação
                            </h4>

                            <div class="space-y-4">
                                <!-- Ação -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ação Realizada</p>
                                    @php
                                        $badgeClasses = match (strtolower($movimentacao->acao)) {
                                            'atribuído',
                                            'atribuido'
                                                => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                            'removido' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                            default => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                        };

                                        $actionIcon = match (strtolower($movimentacao->acao)) {
                                            'atribuído',
                                            'atribuido'
                                                => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" /><polyline points="22 4 12 14.01 9 11.01" /></svg>',
                                            'removido'
                                                => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><circle cx="12" cy="12" r="10" /><line x1="15" x2="9" y1="9" y2="15" /><line x1="9" x2="15" y1="9" y2="15" /></svg>',
                                            default
                                                => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><circle cx="12" cy="12" r="10" /><path d="M12 16v.01" /><path d="M12 8v4" /></svg>',
                                        };
                                    @endphp
                                    <div class="mt-1">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium {{ $badgeClasses }}">
                                            {!! $actionIcon !!}
                                            {{ $movimentacao->acao }}
                                        </span>
                                        <p>{{ $movimentacao->observacoes }}</p>
                                    </div>
                                </div>

                                <!-- Usuário -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Realizado por</p>
                                    <div class="mt-1 flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-gray-600 dark:text-gray-300 font-semibold">{{ substr($movimentacao->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-base text-gray-900 dark:text-gray-100">
                                                {{ $movimentacao->user->name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $movimentacao->user->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data e Hora -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Data e Hora</p>
                                    <div class="mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 mr-2">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        <p class="text-base text-gray-900 dark:text-gray-100">
                                            {{ $movimentacao->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Descrição -->
                                @if ($movimentacao->descricao)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição</p>
                                        <div class="mt-1 p-3 bg-gray-100 dark:bg-gray-700 rounded-md">
                                            <p class="text-base text-gray-900 dark:text-gray-100">
                                                {{ $movimentacao->descricao }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Coluna da Direita - Informações Relacionadas -->
                    <div class="space-y-6">
                        <!-- Manutenção Card -->
                        @if ($movimentacao->manutencao)
                            <div
                                class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="text-purple-500 dark:text-purple-400 mr-2">
                                        <path
                                            d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                                    </svg>
                                    Detalhes da Manutenção
                                </h4>

                                <div class="space-y-4">
                                    <!-- Descrição do Problema -->
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição do
                                            Problema</p>
                                        <div class="mt-1 p-3 bg-gray-100 dark:bg-gray-700 rounded-md">
                                            <p class="text-base text-gray-900 dark:text-gray-100">
                                                {{ $movimentacao->manutencao->descricao_problema }}</p>
                                        </div>
                                    </div>

                                    <!-- Local -->
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Local</p>
                                        <p class="mt-1 text-base text-gray-900 dark:text-gray-100">
                                            {{ $movimentacao->manutencao->local }}</p>
                                    </div>

                                    <!-- Observações -->
                                    @if ($movimentacao->manutencao->observacoes)
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Observações</p>
                                            <div class="mt-1 p-3 bg-gray-100 dark:bg-gray-700 rounded-md">
                                                <p class="text-base text-gray-900 dark:text-gray-100">
                                                    {{ $movimentacao->manutencao->observacoes }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Datas -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de
                                                Abertura</p>
                                            <div class="mt-1 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="text-gray-400 mr-2">
                                                    <rect width="18" height="18" x="3" y="4" rx="2"
                                                        ry="2" />
                                                    <line x1="16" x2="16" y1="2" y2="6" />
                                                    <line x1="8" x2="8" y1="2" y2="6" />
                                                    <line x1="3" x2="21" y1="10" y2="10" />
                                                </svg>
                                                <p class="text-base text-gray-900 dark:text-gray-100">
                                                    {{ $movimentacao->manutencao->data_abertura }}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de
                                                Conclusão</p>
                                            <div class="mt-1 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="text-gray-400 mr-2">
                                                    <rect width="18" height="18" x="3" y="4" rx="2"
                                                        ry="2" />
                                                    <line x1="16" x2="16" y1="2" y2="6" />
                                                    <line x1="8" x2="8" y1="2" y2="6" />
                                                    <line x1="3" x2="21" y1="10" y2="10" />
                                                    <path d="m9 16 2 2 4-4" />
                                                </svg>
                                                <p class="text-base text-gray-900 dark:text-gray-100">
                                                    {{ $movimentacao->manutencao->data_conclusao ?? 'Não concluído' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                        <div class="mt-1">
                                            @if ($movimentacao->manutencao->data_conclusao)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-1">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                        <polyline points="22 4 12 14.01 9 11.01" />
                                                    </svg>
                                                    Concluído
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-1">
                                                        <path
                                                            d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                                                        <path d="M12 8v4" />
                                                        <path d="M12 16h.01" />
                                                    </svg>
                                                    Em Andamento
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Termo Card -->
                        @if ($movimentacao->termo_id)
                            <div
                                class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="text-green-500 dark:text-green-400 mr-2">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                                        <line x1="9" y1="9" x2="10" y2="9" />
                                        <line x1="9" y1="13" x2="15" y2="13" />
                                        <line x1="9" y1="17" x2="15" y2="17" />
                                    </svg>
                                    Detalhes do Termo
                                </h4>

                                <div class="space-y-4">
                                    <!-- ID e Status -->
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Termo ID</p>
                                            <p class="text-base text-gray-900 dark:text-gray-100">
                                                #{{ $movimentacao->termo->id }}</p>
                                        </div>

                                        <div>
                                            @if ($movimentacao->termo->status)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-1">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                        <polyline points="22 4 12 14.01 9 11.01" />
                                                    </svg>
                                                    Ativo
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-1">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <line x1="15" x2="9" y1="9"
                                                            y2="15" />
                                                        <line x1="9" x2="15" y1="9"
                                                            y2="15" />
                                                    </svg>
                                                    Devolvido
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Responsável -->
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Responsável</p>
                                        <div class="mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400 mr-2">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                            <p class="text-base text-gray-900 dark:text-gray-100">
                                                {{ $movimentacao->termo->responsavel->nome }}</p>
                                        </div>
                                    </div>

                                    <!-- Secretaria -->
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Secretaria</p>
                                        <div class="mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400 mr-2">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                                <polyline points="9 22 9 12 15 12 15 22" />
                                            </svg>
                                            <p class="text-base text-gray-900 dark:text-gray-100">
                                                {{ $movimentacao->termo->secretaria->nome }}</p>
                                        </div>
                                    </div>

                                    <!-- Datas -->
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de Entrega
                                            </p>
                                            <div class="mt-1 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="text-gray-400 mr-2">
                                                    <rect width="18" height="18" x="3" y="4" rx="2"
                                                        ry="2" />
                                                    <line x1="16" x2="16" y1="2" y2="6" />
                                                    <line x1="8" x2="8" y1="2" y2="6" />
                                                    <line x1="3" x2="21" y1="10" y2="10" />
                                                </svg>
                                                <p class="text-base text-gray-900 dark:text-gray-100">
                                                    {{ $movimentacao->termo->created_at->format('d/m/Y H:i') }}</p>
                                            </div>
                                        </div>

                                        @if ($movimentacao->termo->data_devolucao)
                                            <div>
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de
                                                    Devolução</p>
                                                <div class="mt-1 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="text-gray-400 mr-2">
                                                        <rect width="18" height="18" x="3" y="4" rx="2"
                                                            ry="2" />
                                                        <line x1="16" x2="16" y1="2"
                                                            y2="6" />
                                                        <line x1="8" x2="8" y1="2"
                                                            y2="6" />
                                                        <line x1="3" x2="21" y1="10"
                                                            y2="10" />
                                                        <path d="m9 16 2 2 4-4" />
                                                    </svg>
                                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                                        {{ $movimentacao->termo->data_devolucao }}</p>
                                                </div>
                                            </div>

                                            <div>
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Responsável
                                                    pela Devolução</p>
                                                <div class="mt-1 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="text-gray-400 mr-2">
                                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                        <circle cx="12" cy="7" r="4" />
                                                    </svg>
                                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                                        {{ $movimentacao->termo->usuarioDevolucao ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Link para o Termo -->
                                    <div class="mt-4">
                                        <a href="{{ route('termo.show', $movimentacao->termo->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 active:bg-green-800 transition-colors duration-200 shadow-sm hover:shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="mr-2">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14 2 14 8 20 8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <polyline points="10 9 9 9 8 9" />
                                            </svg>
                                            Ver Termo Completo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Botão Voltar -->
                <div class="mt-8 flex justify-start">
                    <a href="{{ route('movimentacoes.index') }}"
                        class="flex items-center px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 active:bg-gray-700 transition-colors duration-200 shadow-sm hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Voltar para Lista
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Additional dark mode color for slightly lighter than gray-700 */
        .dark .dark\:bg-gray-750 {
            background-color: rgba(55, 65, 81, 0.5);
        }
    </style>
@endsection
