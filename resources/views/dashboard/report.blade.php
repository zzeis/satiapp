@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-800 min-h-screen pb-10">
        <div class="container mx-auto px-4 py-6">
            <!-- Cabeçalho com título e botão de exportação -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Relatório de Manutenções</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Visão geral do parque tecnológico e atividades de manutenção</p>
                </div>
                <a href="{{ route('dashboard.export.excel') }}"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg flex items-center justify-center transition-all duration-200 shadow-md hover:shadow-lg w-full md:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <path d="M8 13H16"></path>
                        <path d="M8 17H16"></path>
                        <path d="M8 9H10"></path>
                    </svg>
                    Exportar para Excel
                </a>
            </div>

            <!-- Cards com Estatísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                <!-- Total de Computadores -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden relative pb-10">
                    <div class="px-6 py-5 flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-sm font-medium opacity-80">Computadores Ativos</p>
                            <div class="flex items-end mt-1">
                                <p class="text-3xl font-bold">{{ $totalComputadores }}</p>
                                <p class="text-sm ml-2 mb-1 opacity-80">unidades</p>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                <line x1="8" y1="21" x2="16" y2="21"></line>
                                <line x1="12" y1="17" x2="12" y2="21"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-blue-700/30 px-6 py-2 absolute bottom-0 left-0 right-0">
                        <div class="flex items-center text-xs text-white">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                                <span>Desktops em operação</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Total de Notebooks -->
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg overflow-hidden relative pb-10">
                    <div class="px-6 py-5 flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-sm font-medium opacity-80">Notebooks Ativos</p>
                            <div class="flex items-end mt-1">
                                <p class="text-3xl font-bold">{{ $totalNotebooks }}</p>
                                <p class="text-sm ml-2 mb-1 opacity-80">unidades</p>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                <line x1="2" y1="20" x2="22" y2="20"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-indigo-700/30 px-6 py-2 absolute bottom-0 left-0 right-0">
                        <div class="flex items-center text-xs text-white">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                                <span>Equipamentos portáteis</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Total de Impressoras -->
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg overflow-hidden relative pb-10">
                    <div class="px-6 py-5 flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-sm font-medium opacity-80">Impressoras</p>
                            <div class="flex items-end mt-1">
                                <p class="text-3xl font-bold">{{ $totalImpressoras }}</p>
                                <p class="text-sm ml-2 mb-1 opacity-80">unidades</p>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-amber-700/30 px-6 py-2 absolute bottom-0 left-0 right-0">
                        <div class="flex items-center text-xs text-white">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                                <span>Dispositivos de impressão</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Mês com mais manutenções -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg overflow-hidden relative pb-10">
                    <div class="px-6 py-5 flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-sm font-medium opacity-80">Mês com mais manutenções</p>
                            @php
                                $mesesPtBr = [
                                    1 => 'Janeiro',
                                    2 => 'Fevereiro',
                                    3 => 'Março',
                                    4 => 'Abril',
                                    5 => 'Maio',
                                    6 => 'Junho',
                                    7 => 'Julho',
                                    8 => 'Agosto',
                                    9 => 'Setembro',
                                    10 => 'Outubro',
                                    11 => 'Novembro',
                                    12 => 'Dezembro',
                                ];
                                $mesMaisManutencoes = $mesAtualMaisManutencoes
                                    ? $mesesPtBr[$mesAtualMaisManutencoes->mes]
                                    : 'N/A';
                            @endphp
                            <div class="mt-1">
                                <p class="text-2xl font-bold">{{ $mesMaisManutencoes }}</p>
                                <p class="text-sm opacity-80">{{ $mesAtualMaisManutencoes->total ?? 0 }} manutenções</p>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <path d="M8 14h.01"></path>
                                <path d="M12 14h.01"></path>
                                <path d="M16 14h.01"></path>
                                <path d="M8 18h.01"></path>
                                <path d="M12 18h.01"></path>
                                <path d="M16 18h.01"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-purple-700/30 px-6 py-2 absolute bottom-0 left-0 right-0">
                        <div class="flex items-center text-xs text-white">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Período de maior demanda</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Secretaria com mais manutenções -->
                <div class="bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl shadow-lg overflow-hidden relative pb-10">
                    <div class="px-6 py-5 flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-sm font-medium opacity-80">Secretaria mais ativa</p>
                            <div class="mt-1">
                                <p class="text-xl font-bold truncate max-w-[160px]"
                                    title="{{ $secretariaMaisManutencoes->nome ?? 'N/A' }}">
                                    {{ $secretariaMaisManutencoes->nome ?? 'N/A' }}
                                </p>
                                <p class="text-sm opacity-80">{{ $secretariaMaisManutencoes->manutencoes_count ?? 0 }}
                                    manutenções</p>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-rose-700/30 px-6 py-2 absolute bottom-0 left-0 right-0">
                        <div class="flex items-center text-xs text-white">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                <span>Departamento com maior demanda</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tempo médio de resolução -->
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg overflow-hidden relative pb-10">
                    <div class="px-6 py-5 flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-sm font-medium opacity-80">Tempo médio de resolução</p>
                            <div class="mt-1">
                                <p class="text-3xl font-bold">{{ round($tempoMedioDias, 1) }}</p>
                                <div class="flex items-center">
                                    <p class="text-sm opacity-80">dias para conclusão</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-emerald-700/30 px-6 py-2 absolute bottom-0 left-0 right-0">
                        <div class="flex items-center text-xs text-white">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                <span>Eficiência no atendimento</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos e Tabelas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Computadores por Secretaria -->
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="18" y="3" width="4" height="18"></rect>
                            <rect x="10" y="8" width="4" height="13"></rect>
                            <rect x="2" y="13" width="4" height="8"></rect>
                        </svg>
                        Equipamentos por Secretaria
                    </h2>
                    <div class="relative h-72">
                        <canvas id="computadoresChart"></canvas>
                    </div>
                    <div class="flex justify-center mt-4 space-x-6">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Computadores</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Notebooks</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-amber-500 rounded-full mr-2"></span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">Impressoras</span>
                        </div>
                    </div>
                </div>

                <!-- Manutenções por Mês -->
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
                    <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-purple-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="20" x2="12" y2="10"></line>
                            <line x1="18" y1="20" x2="18" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="16"></line>
                        </svg>
                        Manutenções por Mês ({{ date('Y') }})
                    </h2>
                    <div class="relative h-72">
                        <canvas id="manutencoesChart"></canvas>
                    </div>
                    <div class="text-center mt-4">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Total: {{ $manutencoesPorMes->sum('total') }} manutenções no ano
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabela de Detalhes -->
            <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-600 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        Detalhes por Secretaria
                    </h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Total: {{ $equipamentosPorSecretaria->count() }} secretarias
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-600">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Secretaria</th>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                            <line x1="8" y1="21" x2="16" y2="21"></line>
                                            <line x1="12" y1="17" x2="12" y2="21"></line>
                                        </svg>
                                        Computadores
                                    </div>
                                </th>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-purple-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                            <line x1="2" y1="20" x2="22" y2="20"></line>
                                        </svg>
                                        Notebooks
                                    </div>
                                </th>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg>
                                        Impressoras
                                    </div>
                                </th>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                        </svg>
                                        Manutenções
                                    </div>
                                </th>
                                <th
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        Última Manutenção
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($equipamentosPorSecretaria as $secretaria)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-8 w-8 bg-gray-100 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                                <span
                                                    class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr($secretaria->nome, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $secretaria->nome }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                            {{ $secretaria->computadores_count }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">unidades</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-purple-600 dark:text-purple-400">
                                            {{ $secretaria->notebooks_count }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">unidades</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-amber-600 dark:text-amber-400">
                                            {{ $secretaria->impressoras_count }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">unidades</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-rose-100 text-rose-800 dark:bg-rose-800 dark:text-rose-100">
                                            {{ $secretaria->manutencoes_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            @if ($secretaria->ultimaManutencao)
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5 text-emerald-500 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span class="text-emerald-600 dark:text-emerald-400">{{ $secretaria->ultimaManutencao->created_at->format('d/m/Y') }}</span>
                                </div>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">N/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuração de cores e estilos
            Chart.defaults.font.family = "'Inter', 'Helvetica', 'Arial', sans-serif";
            Chart.defaults.color = '#6B7280';

            // Computadores por Secretaria
            const ctx1 = document.getElementById('computadoresChart').getContext('2d');
            const secretarias = {!! json_encode($equipamentosPorSecretaria->pluck('nome')) !!};
            const computadores = {!! json_encode($equipamentosPorSecretaria->pluck('computadores_count')) !!};
            const notebooks = {!! json_encode($equipamentosPorSecretaria->pluck('notebooks_count')) !!};
            const impressoras = {!! json_encode($equipamentosPorSecretaria->pluck('impressoras_count')) !!};

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: secretarias,
                    datasets: [{
                            label: 'Computadores',
                            data: computadores,
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderRadius: 6,
                            borderWidth: 0,
                            maxBarThickness: 25
                        },
                        {
                            label: 'Notebooks',
                            data: notebooks,
                            backgroundColor: 'rgba(139, 92, 246, 0.8)',
                            borderRadius: 6,
                            borderWidth: 0,
                            maxBarThickness: 25
                        },
                        {
                            label: 'Impressoras',
                            data: impressoras,
                            backgroundColor: 'rgba(245, 158, 11, 0.8)',
                            borderRadius: 6,
                            borderWidth: 0,
                            maxBarThickness: 25
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 10,
                            cornerRadius: 6,
                            callbacks: {
                                title: function(tooltipItems) {
                                    return secretarias[tooltipItems[0].dataIndex];
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 10
                                },
                                maxRotation: 45,
                                minRotation: 45
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Manutenções por Mês
            const mesesPtBr = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
            const dadosMeses = Array(12).fill(0);
            @foreach ($manutencoesPorMes as $mes)
                dadosMeses[{{ $mes->mes }} - 1] = {{ $mes->total }};
            @endforeach

            const ctx2 = document.getElementById('manutencoesChart').getContext('2d');
            const gradient = ctx2.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(139, 92, 246, 0.5)');
            gradient.addColorStop(1, 'rgba(139, 92, 246, 0.0)');

            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: mesesPtBr,
                    datasets: [{
                        label: 'Manutenções',
                        data: dadosMeses,
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: 'rgba(139, 92, 246, 1)',
                        tension: 0.3,
                        borderWidth: 3,
                        pointBackgroundColor: 'rgba(139, 92, 246, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(139, 92, 246, 1)',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 10,
                            cornerRadius: 6,
                            displayColors: false,
                            callbacks: {
                                title: function(tooltipItems) {
                                    const monthIndex = tooltipItems[0].dataIndex;
                                    const fullMonths = [
                                        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                                        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro',
                                        'Dezembro'
                                    ];
                                    return fullMonths[monthIndex];
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
