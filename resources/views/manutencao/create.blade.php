@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Título com ícone -->
            <div class="flex items-center mb-6">
                <i data-lucide="tool" class="w-8 h-8 text-blue-500 mr-2"></i>
                <h1 class="text-2xl font-bold text-gray-800">Abrir Chamado de Manutenção - Email</h1>
            </div>

            <!-- Formulário -->
            <form action="{{ route('manutencao.store') }}" method="POST">
                @csrf

                <!-- Número de Série -->
                <div class="mb-6">
                    <label for="numero_serie" class="flex items-center align-center text-sm font-medium text-gray-700 mb-2">
                        <i data-lucide="barcode" class="w-4 h-4 inline-block mr-1"></i>
                        Número de Série
                    </label>
                    <div class="flex items-center">
                        <input
                            type="text"
                            name="numero_serie"
                            id="numero_serie"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                            placeholder="Digite o número de série"
                            required
                            readonly
                        >
                        <button
                            type="button"
                            onclick="abrirModalEquipamentos()"
                            class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300"
                        >
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Campos Dinâmicos (inicialmente ocultos) -->
                <div id="campos-dinamicos" class="hidden">
                    <!-- Descrição do Problema -->
                    <div class="mb-6">
                        <label for="descricao_problema" class="flex items-center align-center text-sm font-medium text-gray-700 mb-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 inline-block mr-1"></i>
                            Descrição do Problema
                        </label>
                        <textarea
                            name="descricao_problema"
                            id="descricao_problema"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                            rows="4"
                            placeholder="Descreva o problema"
                            required
                        ></textarea>
                    </div>

                    <!-- Local -->
                    <div class="mb-6">
                        <label for="local" class="flex items-center align-center text-sm font-medium text-gray-700 mb-2">
                            <i data-lucide="map-pin" class="w-4 h-4 inline-block mr-1"></i>
                            Local
                        </label>
                        <input
                            type="text"
                            name="local"
                            id="local"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                            placeholder="Digite o local do problema"
                        >
                    </div>

                    <!-- Observações -->
                    <div class="mb-6">
                        <label for="observacoes" class="flex items-center align-center text-sm font-medium text-gray-700 mb-2">
                            <i data-lucide="clipboard-list" class="w-4 h-4 inline-block mr-1"></i>
                            Observações
                        </label>
                        <textarea
                            name="observacoes"
                            id="observacoes"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                            rows="3"
                            placeholder="Adicione observações adicionais"
                        ></textarea>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="flex justify-end align-center items-center">
                        <button
                            type="submit"
                            class="flex items-center bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300"
                        >
                            <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                            Abrir Chamado
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

   <!-- Modal de Seleção de Equipamentos -->
<div id="modal-equipamentos" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/2 p-6">
        <h2 class="text-xl font-bold mb-4">Selecionar Equipamento</h2>

        <!-- Filtros -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <input
                type="text"
                id="filtro-numero-serie"
                class="px-4 py-2 border border-gray-300 rounded-lg"
                placeholder="Número de Série"
            >
            <select id="filtro-tipo" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Tipo</option>
                @foreach($tiposEquipamentos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                @endforeach
            </select>
            <select id="filtro-status" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Status</option>
                <option value="estoque">Estoque</option>
                <option value="em_uso">Em Uso</option>
                <option value="manutencao">Manutenção</option>
                <option value="descartado">Descartado</option>
            </select>
            <select id="filtro-secretaria" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Secretaria</option>
                @foreach($secretarias as $secretaria)
                    <option value="{{ $secretaria->id }}">{{ $secretaria->nome }}</option>
                @endforeach
            </select>
        </div>

        <!-- Lista de Equipamentos -->
        <div id="lista-equipamentos" class="max-h-96 overflow-y-auto" onscroll="verificarScroll()">
            <!-- Os equipamentos serão carregados aqui via JavaScript -->
        </div>

        <!-- Botões do Modal -->
        <div class="mt-4 flex justify-end">
            <button
                onclick="fecharModalEquipamentos()"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300"
            >
                Fechar
            </button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    let paginaAtual = 1;
    let carregando = false;

    function abrirModalEquipamentos() {
        document.getElementById('modal-equipamentos').classList.remove('hidden');
        paginaAtual = 1; // Reinicia a paginação
        document.getElementById('lista-equipamentos').innerHTML = ''; // Limpa a lista
        carregarEquipamentos();
    }

    function fecharModalEquipamentos() {
        document.getElementById('modal-equipamentos').classList.add('hidden');
    }

    function carregarEquipamentos() {
        if (carregando) return;
        carregando = true;

        const filtroNumeroSerie = document.getElementById('filtro-numero-serie').value;
        const filtroTipo = document.getElementById('filtro-tipo').value;
        const filtroStatus = document.getElementById('filtro-status').value;
        const filtroSecretaria = document.getElementById('filtro-secretaria').value;

        fetch(`/equipamentos/filtrar?numero_serie=${filtroNumeroSerie}&tipo_id=${filtroTipo}&status=${filtroStatus}&secretaria_id=${filtroSecretaria}&page=${paginaAtual}`)
            .then(response => response.json())
            .then(data => {
                const listaEquipamentos = document.getElementById('lista-equipamentos');

                data.data.forEach(equipamento => {
                    const item = document.createElement('div');
                    item.className = 'p-2 border-b border-gray-200 hover:bg-gray-100 cursor-pointer';
                    item.innerText = `${equipamento.numero_serie} - ${equipamento.modelo}`;
                    item.onclick = () => selecionarEquipamento(equipamento);
                    listaEquipamentos.appendChild(item);
                });

                carregando = false;
                paginaAtual++; // Prepara para carregar a próxima página
            });
    }

    function selecionarEquipamento(equipamento) {
        document.getElementById('numero_serie').value = equipamento.numero_serie;
        document.getElementById('campos-dinamicos').classList.remove('hidden');
        fecharModalEquipamentos();
    }

    function verificarScroll() {
        const listaEquipamentos = document.getElementById('lista-equipamentos');
        if (listaEquipamentos.scrollTop + listaEquipamentos.clientHeight >= listaEquipamentos.scrollHeight - 10) {
            carregarEquipamentos(); // Carrega mais equipamentos ao chegar no final
        }
    }

    // Atualiza a lista de equipamentos ao alterar os filtros
    document.getElementById('filtro-numero-serie').addEventListener('input', () => {
        paginaAtual = 1; // Reinicia a paginação ao filtrar
        document.getElementById('lista-equipamentos').innerHTML = ''; // Limpa a lista
        carregarEquipamentos();
    });
    document.getElementById('filtro-tipo').addEventListener('change', () => {
        paginaAtual = 1;
        document.getElementById('lista-equipamentos').innerHTML = '';
        carregarEquipamentos();
    });
    document.getElementById('filtro-status').addEventListener('change', () => {
        paginaAtual = 1;
        document.getElementById('lista-equipamentos').innerHTML = '';
        carregarEquipamentos();
    });
    document.getElementById('filtro-secretaria').addEventListener('change', () => {
        paginaAtual = 1;
        document.getElementById('lista-equipamentos').innerHTML = '';
        carregarEquipamentos();
    });
</script>
@endsection