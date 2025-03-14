@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <!-- Dashboard Header -->
            <div class="relative bg-gradient-to-r from-blue-600 to-gray-600 px-6 py-8">
                <div class="absolute inset-0 bg-black opacity-10 pattern-dots"></div>
                <h1 class="text-3xl font-bold text-white relative z-10">Dashboard</h1>
                <p class="text-indigo-100 mt-2 relative z-10">Visão geral do sistema de gerenciamento de equipamentos</p>
            </div>

            <!-- Metric Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                <!-- Total de Equipamentos -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-600">
                    <div
                        class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 border-b border-blue-100 dark:border-blue-700/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total de Equipamentos</h2>
                            <div class="bg-blue-500 text-white p-2 rounded-lg shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-server">
                                    <rect width="20" height="8" x="2" y="2" rx="2" ry="2" />
                                    <rect width="20" height="8" x="2" y="14" rx="2" ry="2" />
                                    <line x1="6" x2="6" y1="6" y2="6" />
                                    <line x1="6" x2="6" y1="18" y2="18" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalEquipamentos }}</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Equipamentos registrados</span>
                        </div>
                    </div>
                </div>

                <!-- Equipamentos em Estoque -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-600">
                    <div
                        class="p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 border-b border-green-100 dark:border-green-700/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Em Estoque</h2>
                            <div class="bg-green-500 text-white p-2 rounded-lg shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-package">
                                    <path d="M16.5 9.4 7.55 4.24" />
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                    <path d="M3.27 6.96 12 12.01l8.73-5.05" />
                                    <path d="M12 22.08V12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $equipamentosEstoque }}</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Disponíveis</span>
                        </div>
                    </div>
                </div>

                <!-- Equipamentos em Uso -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-600">
                    <div
                        class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 border-b border-purple-100 dark:border-purple-700/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Em Uso</h2>
                            <div class="bg-purple-500 text-white p-2 rounded-lg shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-laptop">
                                    <path
                                        d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $equipamentosEmUso }}</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Em operação</span>
                        </div>
                    </div>
                </div>

                <!-- Manutenções Abertas -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-600">
                    <div
                        class="p-4 bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 border-b border-red-100 dark:border-red-700/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Manutenções</h2>
                            <div class="bg-red-500 text-white p-2 rounded-lg shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-alert-triangle">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $manutencoesAbertas }}</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Pendentes</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="p-6 space-y-6">
                <!-- Equipamentos por Secretaria Chart -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-600">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Equipamentos por Secretaria</h2>
                        <div class="flex space-x-2">

                        </div>
                    </div>
                    <div class="relative h-80">
                        <canvas id="equipamentosPorSecretariaChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Additional Charts Section (2-column layout) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Distribution Chart -->
                    <div
                        class="bg-white dark:bg-gray-700 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-600">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200 mb-6">Distribuição por Tipo</h2>
                        <div class="relative h-64">
                            <canvas id="distribuicaoChart" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    <!-- Status Chart -->
                    <div
                        class="bg-white dark:bg-gray-700 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-600">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-6">Status dos Equipamentos</h2>
                        <div class="relative h-64">
                            <canvas id="statusChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <!-- Recent Activity Section -->
            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Atividades Recentes</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Equipamento</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Ação</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Usuário</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Data</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($atividadesRecentes as $atividade)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        {{ $atividade->equipamento->tipo->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $atividade->acao === 'Atribuído' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                            {{ $atividade->acao }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        {{ $atividade->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $atividade->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclua o Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuração de cores para os gráficos
            const colors = {
                primary: 'rgba(79, 70, 229, 0.8)',
                primaryBorder: 'rgba(79, 70, 229, 1)',
                secondary: ['rgba(59, 130, 246, 0.7)', 'rgba(16, 185, 129, 0.7)', 'rgba(139, 92, 246, 0.7)',
                    'rgba(239, 68, 68, 0.7)', 'rgba(245, 158, 11, 0.7)'
                ],
                secondaryBorder: ['rgba(59, 130, 246, 1)', 'rgba(16, 185, 129, 1)', 'rgba(139, 92, 246, 1)',
                    'rgba(239, 68, 68, 1)', 'rgba(245, 158, 11, 1)'
                ]
            };

            // Gráfico de Equipamentos por Secretaria
            const ctxBar = document.getElementById('equipamentosPorSecretariaChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($secretarias->pluck('nome')) !!},
                    datasets: [{
                        label: 'Equipamentos',
                        data: {!! json_encode($secretarias->pluck('equipamentos_count')) !!},
                        backgroundColor: colors.primary,
                        borderColor: colors.primaryBorder,
                        borderWidth: 1,
                        borderRadius: 4,
                        barThickness: 20,
                        maxBarThickness: 30
                    }]
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
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico de Distribuição por Tipo
            const ctxPie = document.getElementById('distribuicaoChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($distribuicaoPorTipo->pluck('nome')) !!},
                    datasets: [{
                        data: {!! json_encode($distribuicaoPorTipo->pluck('equipamentos_count')) !!},
                        backgroundColor: colors.secondary,
                        borderColor: colors.secondaryBorder,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                boxWidth: 12,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });

            // Gráfico de Status dos Equipamentos
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Estoque', 'Em uso'],
                    datasets: [{
                        data: [
                            {{ $statusEquipamentos['estoque'] != '' ? $statusEquipamentos['estoque'] : 0 }},
                            {{ $statusEquipamentos['em_uso'] }},

                        ],
                        backgroundColor: colors.secondary,
                        borderColor: colors.secondaryBorder,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                boxWidth: 12,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });

          
        });
    </script>

    <!-- Adicione este CSS ao seu arquivo de estilos ou no head -->
    <style>
        .pattern-dots {
            background-image: radial-gradient(currentColor 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Animações para os cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .grid>div {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .grid>div:nth-child(1) {
            animation-delay: 0.1s;
        }

        .grid>div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .grid>div:nth-child(3) {
            animation-delay: 0.3s;
        }

        .grid>div:nth-child(4) {
            animation-delay: 0.4s;
        }
    </style>
@endsection
