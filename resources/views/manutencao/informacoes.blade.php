@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">


        <!-- Botão Voltar -->
        <a href="{{ route('manutencao.index') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded-md mb-4 inline-block hover:bg-gray-600 transition duration-300">
            <i data-lucide="arrow-left" class="w-4 h-4 inline-block mr-1"></i> Voltar
        </a>

        <!-- Informações da Manutenção -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center mb-4">
                <i data-lucide="wrench" class="w-6 h-6 text-blue-500 mr-2"></i>
                <h2 class="text-xl font-bold text-gray-800">Informações Manutenção</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">

                    <label class="block text-sm font-medium text-gray-700">Data de Abertura</label>
                    <p class="mt-1 text-gray-900">
                        {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">

                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->status }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">

                    <label class="block text-sm font-medium text-gray-700">Descrição do Problema</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->descricao_problema }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">

                    <label class="block text-sm font-medium text-gray-700">Observações</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->observacoes }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">

                    <label class="block text-sm font-medium text-gray-700">Local Especificado</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->local }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">

                    <label class="block text-sm font-medium text-gray-700">Aberto por</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->user->name }}</p>
                </div>
            </div>
        </div>

        <!-- Informações do Equipamento -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center mb-4">
                <i data-lucide="hard-drive" class="w-6 h-6 text-blue-500 mr-2"></i>
                <h2 class="text-xl font-bold text-gray-800">Informações do Equipamento</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if ($manutencao->equipamento)
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Número de Série</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->numero_serie }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Modelo</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->modelo }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Tipo</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->tipo->nome }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Responsável</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->responsavel->nome ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Secretaria</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->secretaria->nome ?? 'N/A' }}</p>
                    </div>
                @elseif ($manutencao->equipamento_novo_id)
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Número de Série (Novo)</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamentoNovo->numero_serie }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Modelo (Novo)</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamentoNovo->modelo }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Tipo (Novo)</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamentoNovo->tipo->nome }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">

                        <label class="block text-sm font-medium text-gray-700">Equipamento Antigo</label>
                        <p class="mt-1 text-gray-900">
                            {{ json_decode($manutencao->dados_equipamento_antigo)->numero_serie }} (Substituído)
                        </p>
                    </div>
                @else
                    <p class="text-red-500">Equipamento indisponível</p>
                @endif
            </div>
        </div>

        <!-- Movimentações -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
                <i data-lucide="move" class="w-6 h-6 text-blue-500 mr-2"></i>
                <h2 class="text-xl font-bold text-gray-800">Movimentações</h2>
            </div>
            @if ($manutencao->movimentacoes->isEmpty())
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
                        @foreach ($manutencao->movimentacoes as $movimentacao)
                            <tr class="hover:bg-gray-50 transition duration-300">

                                <td class="px-4 py-2 text-sm text-gray-700">{{ $movimentacao->acao }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $movimentacao->descricao }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $movimentacao->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
