@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Termos de Entrega</h1>
            <!-- Botão Criar Novo Termo -->
            <a href="{{ route('termo.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus mr-2">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Criar Novo Termo
            </a>
        </div>

        <!-- Filtros e Pesquisa -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form action="{{ route('termo.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Filtro por Secretaria -->
                    <div>
                        <label for="secretaria" class="block text-sm font-medium text-gray-700">Secretaria</label>
                        <select name="secretaria" id="secretaria"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todas</option>
                            @foreach ($secretarias as $secretaria)
                                <option value="{{ $secretaria->id }}"
                                    {{ request('secretaria') == $secretaria->id ? 'selected' : '' }}>
                                    {{ $secretaria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todos</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Devolvido</option>
                        </select>
                    </div>

                    <!-- Campo de Pesquisa -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Pesquisar</label>
                        <input type="text" name="search" id="search"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Número de série, nome ou CPF" value="{{ request('search') }}">
                    </div>

                    <!-- Botão de Pesquisa -->
                    <div class="self-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabela de Termos de Entrega -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nome da Pessoa</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">CPF</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Secretaria</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Data de Entrega</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($termos as $termo)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $termo->responsavel->nome }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $termo->responsavel->cpf }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $termo->secretaria->nome }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($termo->data_entrega)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                @if ($termo->status)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">Em uso</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full">Devolvido</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="{{ route('termo.show', $termo->id) }}" class="text-blue-600">
                                    <i data-lucide="receipt-text"></i>
                                </a>
                                <!-- Ícone de Devolução -->
                                @if ($termo->status)
                                    <a href="#devolucao" class="text-yellow-500" onclick="openModal('{{ $termo->id }}')">
                                        <i data-lucide="undo-2"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-2 text-center">Nenhum termo de entrega encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="mt-4">
                {{ $termos->links() }}
            </div>
        </div>
    </div>

    <!-- Modal de Devolução -->
    <div id="modal-devolucao" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 p-6">
            <h2 class="text-xl font-bold mb-4">Registrar Devolução</h2>
            <form id="form-devolucao" method="POST" action="{{ route('termo.devolucao', ['termoEntrega' => $termo->id]) }}">
                @csrf
                <input type="hidden" name="termo_id" id="termo_id">
                <div class="mb-4">
                    <label for="observacoes_devolucao" class="block text-sm font-medium text-gray-700">Observações</label>
                    <textarea name="observacoes_devolucao" id="observacoes_devolucao" rows="4"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Digite as observações sobre a devolução"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Confirmar Devolução
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para Controlar o Modal -->
    <script>
        function openModal(termoId) {
            document.getElementById('form-devolucao').action = `/TermoDeEntrega/${termoId}/devolucao`;
            document.getElementById('modal-devolucao').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-devolucao').classList.add('hidden');
        }

        document.getElementById('modal-devolucao').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });
    </script>
@endsection