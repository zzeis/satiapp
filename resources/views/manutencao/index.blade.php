@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Lista de Manutenções</h1>

        <!-- Botão Abrir Chamado -->
        <a href="{{ route('manutencao.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">
            Abrir Chamado
        </a>

        <!-- Filtros e Pesquisa -->
        <form action="{{ route('manutencao.index') }}" method="GET" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Filtro por Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todos</option>
                        <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
                        <option value="em_andamento" {{ request('status') == 'em_andamento' ? 'selected' : '' }}>Em
                            Andamento</option>
                        <option value="concluido" {{ request('status') == 'concluido' ? 'selected' : '' }}>Concluído
                        </option>
                        <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>Cancelado
                        </option>
                    </select>
                </div>

                <!-- Pesquisa por Número de Série -->
                <div>
                    <label for="numero_serie" class="block text-sm font-medium text-gray-700">Número de Série</label>
                    <input type="text" name="numero_serie" id="numero_serie"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('numero_serie') }}">
                </div>

                <!-- Botão de Pesquisa -->
                <div class="self-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Filtrar
                    </button>
                </div>
            </div>
        </form>

        <!-- Tabela de Manutenções -->
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2">Número de Série</th>
                    <th class="px-4 py-2">Modelo</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Data de Abertura</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manutencoes as $manutencao)
                    <tr>
                        <td class="border px-4 py-2">{{ $manutencao->equipamento->numero_serie }}</td>
                        <td class="border px-4 py-2">{{ $manutencao->equipamento->modelo }}</td>
                        <td class="border px-4 py-2">{{ $manutencao->status }}</td>
                        <td class="border px-4 py-2">
                            {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">
                            <!-- Botão Concluir -->
                            @if ($manutencao->status == 'aberto' || $manutencao->status == 'em_andamento')
                                <form action="{{ route('manutencao.update', $manutencao->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="concluido">
                                    <button type="submit"
                                        class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600">
                                        Concluir
                                    </button>
                                </form>
                            @endif

                            <!-- Botão Registrar Retirada -->
                            <a href="{{ route('manutencao.registrar-retirada', $manutencao->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-600">
                                Retirar
                            </a>

                            <!-- Botão Cancelar -->
                            @if ($manutencao->status == 'aberto' || $manutencao->status == 'em_andamento')
                                <form action="{{ route('manutencao.update', $manutencao->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="cancelado">
                                    <button type="submit"
                                        class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">
                                        Cancelar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $manutencoes->links() }}
        </div>
    </div>
@endsection
