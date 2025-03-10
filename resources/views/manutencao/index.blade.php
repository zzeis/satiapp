@extends('layouts.app')
@section('title', 'Manutenções')
@section('content')
    <div class="container mx-auto px-4 py-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Manutenções</h1>
            <!-- Botão Abrir Chamado -->
            <a href="{{ route('manutencao.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus mr-2">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Abrir Chamado
            </a>

        </div>

        <!-- Filtros e Pesquisa -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
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
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Tabela de Manutenções -->
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Número de Série</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Modelo</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Data de Abertura</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>


                <tbody class="divide-y divide-gray-200">
                    @foreach ($manutencoes as $manutencao)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="px-6 py-4 text-sm text-center text-gray-700">
                                <a class="text-blue-500 hover:underline"
                                    href="{{ route('manutencao.informacoes', $manutencao->id) }}">
                                    @if ($manutencao->equipamento)
                                        {{ $manutencao->equipamento->numero_serie }}
                                    @elseif ($manutencao->equipamento_novo_id && $manutencao->equipamentoNovo)
                                        {{ $manutencao->equipamentoNovo->numero_serie }}
                                        <span class="text-xs text-gray-500">(substituiu
                                            {{ json_decode($manutencao->dados_equipamento_antigo)->numero_serie }})</span>
                                    @elseif ($manutencao->dados_equipamento_antigo)
                                        {{ json_decode($manutencao->dados_equipamento_antigo)->numero_serie }}
                                        <span class="text-xs text-gray-500">(equipamento substituído)</span>
                                    @else
                                        <span class="text-red-500">Equipamento indisponível</span>
                                    @endif
                                </a>
                            </td>

                            <td class="px-6 py-4 text-sm text-center text-gray-700">
                                @if ($manutencao->equipamento)
                                    {{ $manutencao->equipamento->modelo }}
                                @elseif ($manutencao->equipamento_novo_id && $manutencao->equipamentoNovo)
                                    {{ $manutencao->equipamentoNovo->modelo }}
                                @elseif ($manutencao->dados_equipamento_antigo)
                                    {{ json_decode($manutencao->dados_equipamento_antigo)->modelo }}
                                    <span class="text-xs text-gray-500">(equipamento substituído)</span>
                                @else
                                    <span class="text-red-500">Equipamento indisponível</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-center text-gray-700">
                                @php
                                    $statusClasses = [
                                        'em_andamento' => 'bg-blue-100 text-blue-800',
                                        'concluido' => 'bg-green-100 text-green-800',
                                        'aberto' => 'bg-yellow-100 text-yellow-800',
                                    ];
                                    $statusTexts = [
                                        'aberto' => 'Aberto',
                                        'em_andamento' => 'Em Manutenção',
                                        'concluido' => 'Concluído',
                                    ];
                                @endphp
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClasses[$manutencao->status] }}">
                                    {{ $statusTexts[$manutencao->status] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-center text-gray-700">
                                {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}
                            </td>

                            <td class="flex justify-center gap-1 px-6 py-4 text-sm text-gray-700 text-center">
                                <!-- Botão Gerenciar Manutenção -->
                                @if ($manutencao->status == 'concluido')
                                    <a href="{{ route('manutencao.informacoes', $manutencao->id) }}">
                                        <i class="text-blue-600" data-lucide="receipt-text"></i>
                                    </a>
                                @endif

                                @if ($manutencao->status == 'em_andamento' || $manutencao->status == 'aberto')
                                    <button onclick="openManageModal('{{ $manutencao->id }}')"
                                        class="bg-purple-500 text-white px-2 py-1 rounded-md hover:bg-purple-600">
                                        Gerenciar
                                    </button>
                                @endif

                                <!-- Botão Registrar Retirada -->
                                @if ($manutencao->status == 'aberto')
                                    <form action="{{ route('manutencao.retirar', $manutencao->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="local" value="Local de retirada">
                                        <button type="submit"
                                            class="bg-yellow-500 text-white px-2 py-1 h-10 rounded-md">Retirar</button>
                                    </form>
                                @endif

                                <!-- Botão Cancelar -->
                                @if ($manutencao->status == 'aberto' || $manutencao->status == 'em_andamento')
                                    <form action="{{ route('manutencao.destroy', $manutencao->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelado">
                                        <button type="submit"
                                            class="bg-red-500 text-white px-2 py-1 h-10 rounded-md hover:bg-red-600">
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
            <div class="mt-4 text-center p-4 mx-auto">
                {{ $manutencoes->links() }}
            </div>
        </div>


        <!-- Modal Gerenciar Manutenção -->
        <div id="manageModal"
            class="fixed flex overflow  overflow-y-auto inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-1/3 max-h-[80vh] overflow-y-auto">
                <h2 class="text-xl font-bold mb-4">Gerenciar Manutenção</h2>
                <form id="manageForm" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Campos para exibir informações -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Local</label>
                        <p id="local" class="mt-1 text-gray-900"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tipo de Equipamento</label>
                        <p id="tipo_equipamento" class="mt-1 text-gray-900"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Descrição do Defeito</label>
                        <p id="descricao_defeito" class="mt-1 text-gray-900"></p>
                    </div>
                    <!-- Campos para ações -->
                    <div class="mb-4">
                        <label for="action" class="block text-sm font-medium text-gray-700">Ação</label>
                        <select name="action" id="action"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="concerto">Concerto</option>
                            <option value="troca">Troca</option>
                        </select>
                    </div>
                    <!-- Campos para troca (inicialmente ocultos) -->
                    <div id="trocaFields" class="hidden">
                        <div class="mb-4">
                            <label for="novo_modelo" class="block text-sm font-medium text-gray-700">Modelo do Novo
                                Equipamento</label>
                            <input type="text" name="modelo" id="novo_modelo"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="numero_serie" class="block text-sm font-medium text-gray-700">Número de Série do
                                Novo Equipamento</label>
                            <input type="text" name="numero_serie" id="novo_numero_serie"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="novo_tipo" class="block text-sm font-medium text-gray-700">Tipo do Novo
                                Equipamento</label>
                            <input type="text" name="tipo_novo" id="novo_tipo"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                readonly>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea name="observacoes" id="observacoes"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="desativar_equipamento" class="block text-sm font-medium text-gray-700">Desativar
                            Equipamento</label>
                        <input type="checkbox" name="desativar_equipamento" id="desativar_equipamento"
                            class="mt-1 block">
                    </div>
                    <!-- Campo oculto para enviar o status -->
                    <input type="hidden" name="status" id="status_" value="">
                    <div class="flex justify-end">
                        <button type="button" onclick="closeManageModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">Cancelar</button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            let manutencaoId;

            function openManageModal(id) {

                manutencaoId = id;
                // Busca os detalhes da manutenção via AJAX
                fetch(`/manutencao/${manutencaoId}/detalhes`)
                    .then(response => response.json())
                    .then(data => {
                        // Preenche os campos do modal com os dados retornados
                        document.getElementById('local').textContent = data.local;
                        document.getElementById('tipo_equipamento').textContent = data.tipo_equipamento;
                        document.getElementById('descricao_defeito').textContent = data.descricao_defeito;

                        // Preenche o campo "tipo" do novo equipamento com o mesmo tipo do equipamento defeituoso
                        document.getElementById('novo_tipo').value = data.tipo_equipamento;

                        document.getElementById('manageForm').action = `/manutencao/${manutencaoId}/concluir`;


                        // Exibe o modal
                        document.getElementById('manageModal').classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Erro ao buscar detalhes da manutenção:', error);
                    });
            }

            function closeManageModal() {
                document.getElementById('manageModal').classList.add('hidden');
            }

            // Mostra ou oculta os campos de troca conforme a ação selecionada
            document.getElementById('action').addEventListener('change', function() {
                const action = this.value;
                const trocaFields = document.getElementById('trocaFields');
                const statusField = document.getElementById('status_');

                if (action === 'troca') {
                    trocaFields.classList.remove('hidden');

                    statusField.value = 'concluido'; // Ou outro status adequado
                    document.getElementById('manageForm').action = `/manutencao/${manutencaoId}/trocar`;
                    console.log('troca');
                } else {
                    trocaFields.classList.add('hidden');
                    statusField.value = 'concluido';
                    document.getElementById('manageForm').action = `/manutencao/${manutencaoId}/concluir`;
                }
            });
        </script>
    @endsection
