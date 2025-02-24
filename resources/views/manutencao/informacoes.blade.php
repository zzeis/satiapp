@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Detalhes da Manutenção</h1>

        <!-- Botão Voltar -->
        <a href="{{ route('manutencao.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mb-4 inline-block">
            Voltar
        </a>

        <!-- Informações da Manutenção -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-bold mb-4">Informações da Manutenção</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data de Abertura</label>
                    <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->status }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Descrição do Problema</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->descricao_problema }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Observações</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->observacoes }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Aberto por</label>
                    <p class="mt-1 text-gray-900">{{ $manutencao->user->name }}</p>
                </div>
            </div>
        </div>

        <!-- Informações do Equipamento -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-bold mb-4">Informações do Equipamento</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if ($manutencao->equipamento)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Número de Série</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->numero_serie }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Modelo</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->modelo }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->tipo->nome }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Responsável</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamento->responsavel->name ?? 'N/A' }}</p>
                    </div>
                @elseif ($manutencao->equipamento_novo_id)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Número de Série (Novo)</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamentoNovo->numero_serie }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Modelo (Novo)</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamentoNovo->modelo }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo (Novo)</label>
                        <p class="mt-1 text-gray-900">{{ $manutencao->equipamentoNovo->tipo->nome }}</p>
                    </div>
                    <div>
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
            <h2 class="text-xl font-bold mb-4">Movimentações</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Ação</th>
                        <th class="px-4 py-2">Descrição</th>
                        <th class="px-4 py-2">Data</th>
                        <th class="px-4 py-2">Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manutencao->movimentacoes as $movimentacao)
                        <tr>
                            <td class="border px-4 py-2">{{ $movimentacao->acao }}</td>
                            <td class="border px-4 py-2">{{ $movimentacao->descricao }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="border px-4 py-2">{{ $movimentacao->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection