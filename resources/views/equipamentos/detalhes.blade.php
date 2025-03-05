@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Botão Voltar -->
        <a href="{{ route('equipamentos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mb-4 inline-block hover:bg-gray-600 transition duration-300">
            <i data-lucide="arrow-left" class="w-4 h-4 inline-block mr-1"></i> Voltar
        </a>

        <!-- Informações do Equipamento -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center mb-4">
                <i data-lucide="hard-drive" class="w-6 h-6 text-blue-500 mr-2"></i>
                <h2 class="text-xl font-bold text-gray-800">Informações do Equipamento</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700">Número de Série</label>
                    <p class="mt-1 text-gray-900">{{ $equipamento->numero_serie }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700">Modelo</label>
                    <p class="mt-1 text-gray-900">{{ $equipamento->modelo }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700">Tipo</label>
                    <p class="mt-1 text-gray-900">{{ $equipamento->tipo->nome }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700">Responsável</label>
                    <p class="mt-1 text-gray-900">{{ $equipamento->responsavel->nome ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Manutenções -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center mb-4">
                <i data-lucide="wrench" class="w-6 h-6 text-blue-500 mr-2"></i>
                <h2 class="text-xl font-bold text-gray-800">Manutenções</h2>
            </div>
            @if ($equipamento->manutencoes->isEmpty())
                <p class="text-gray-600">Nenhuma manutenção registrada para este equipamento.</p>
            @else
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Data de Abertura</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Descrição do Problema</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Aberto por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipamento->manutencoes as $manutencao)
                            <tr class="hover:bg-gray-50 transition duration-300 text-center">
                                <td class="px-4 py-2 text-sm text-gray-700 text-center">
                                    {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-center">
                                    @php
                                        $statusClasses = [
                                            'aberto' => 'bg-yellow-100 text-yellow-800',
                                            'em_andamento' => 'bg-blue-100 text-blue-800',
                                            'concluido' => 'bg-green-100 text-green-800',
                                            'cancelado' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusTexts = [
                                            'aberto' => 'Aberto',
                                            'em_andamento' => 'Em Andamento',
                                            'concluido' => 'Concluído',
                                            'cancelado' => 'Cancelado',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClasses[$manutencao->status] }}">
                                        {{ $statusTexts[$manutencao->status] }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $manutencao->descricao_problema }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $manutencao->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Movimentações -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
                <i data-lucide="move" class="w-6 h-6 text-blue-500 mr-2"></i>
                <h2 class="text-xl font-bold text-gray-800">Movimentações</h2>
            </div>
            @if ($equipamento->movimentacoes->isEmpty())
                <p class="text-gray-600">Nenhuma movimentação registrada para este equipamento.</p>
            @else
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Ação</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Descrição</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Data</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipamento->movimentacoes as $movimentacao)
                            <tr class="hover:bg-gray-50 transition duration-300">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $movimentacao->acao }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $movimentacao->descricao }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $movimentacao->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection