@extends('layouts.app')

@section('title', 'Abrir Manutenção')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        
            <div class="border-b border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-3">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Abrir Chamado de Manutenção</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Preencha os dados para registrar um novo chamado de manutenção</p>
            </div>

            <!-- Formulário -->
            <form action="{{ route('manutencao.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Número de Série -->
                <div class="mb-8">
                    <label for="numero_serie" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-2">
                            <path d="M4 7V4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H6a2 2 0 0 0-2 2v3" />
                            <path d="M2 14h12" />
                            <path d="m9 18 3-3-3-3" />
                        </svg>
                        Número de Série
                    </label>
                    <div class="flex items-center">
                        <input
                            type="text"
                            name="numero_serie"
                            id="numero_serie"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 bg-gray-50"
                            placeholder="Selecione um equipamento"
                            required
                            readonly
                        >
                        <button
                            type="button"
                            onclick="abrirModalEquipamentos()"
                            class="ml-3 inline-flex items-center px-4 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 shadow-md hover:shadow-lg"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                            Buscar
                        </button>
                    </div>
                </div>

                <!-- Campos Dinâmicos (inicialmente ocultos) -->
                <div id="campos-dinamicos" class="hidden space-y-6">
                    <!-- Descrição do Problema -->
                    <div class="group">
                        <label for="descricao_problema" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" x2="12" y1="8" y2="12" />
                                <line x1="12" x2="12.01" y1="16" y2="16" />
                            </svg>
                            Descrição do Problema
                        </label>
                        <textarea
                            name="descricao_problema"
                            id="descricao_problema"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                            rows="4"
                            placeholder="Descreva detalhadamente o problema encontrado"
                            required
                        ></textarea>
                    </div>

                    <!-- Local -->
                    <div class="group">
                        <label for="local" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            Local
                        </label>
                        <input
                            type="text"
                            name="local"
                            id="local"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Informe o local onde o equipamento está"
                        >
                    </div>

                    <!-- Observações -->
                    <div class="group">
                        <label for="observacoes" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" x2="8" y1="13" y2="13" />
                                <line x1="16" x2="8" y1="17" y2="17" />
                                <line x1="10" x2="8" y1="9" y2="9" />
                            </svg>
                            Observações
                        </label>
                        <textarea
                            name="observacoes"
                            id="observacoes"
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                            rows="3"
                            placeholder="Informações adicionais que possam ajudar na manutenção"
                        ></textarea>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('manutencao.index') }}"
                            class="flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                            Voltar
                        </a>

                        <button
                            type="submit"
                            class="flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:translate-y-[-2px] active:translate-y-0"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Finalizar Chamado
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Seleção de Equipamentos -->
    <div id="modal-equipamentos" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-4xl max-h-[90vh] overflow-hidden mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400 mr-2">
                        <path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16" />
                    </svg>
                    Selecionar Equipamento
                </h2>
                <button type="button" onclick="fecharModalEquipamentos()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <!-- Filtros -->
            <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="group">
                    <label for="filtro-numero-serie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Número de Série
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="filtro-numero-serie"
                            class="block w-full px-4 py-3 pl-10 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Buscar por número de série"/>
                       
                    </div>
                </div>
                
                <div class="group">
                    <label for="filtro-tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Tipo
                    </label>
                    <div class="relative">
                        <select id="filtro-tipo" 
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                            <option value="">Todos os tipos</option>
                            @foreach($tiposEquipamentos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="group">
                    <label for="filtro-tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Propriedade
                    </label>
                    <div class="relative">
                        <select id="filtro-tipo-propriedade" 
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                            <option value="">Todos os tipos</option>
                            <option value="alugado">Alugado</option>
                            <option value="municipal">Municipal</option>
                        </select>
                        
                    </div>
                </div>
                
                <div class="group">
                    <label for="filtro-status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Status
                    </label>
                    <div class="relative">
                        <select id="filtro-status" 
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                            <option value="">Todos os status</option>
                            <option value="estoque">Estoque</option>
                            <option value="em_uso">Em Uso</option>
                            
                        </select>
                        
                    </div>
                </div>
                
                <div class="group">
                    <label for="filtro-secretaria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Secretaria
                    </label>
                    <div class="relative">
                        <select id="filtro-secretaria" 
                            class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                            <option value="">Todas as secretarias</option>
                            @foreach($secretarias as $secretaria)
                                <option value="{{ $secretaria->id }}">{{ $secretaria->nome }}</option>
                            @endforeach
                        </select>
                      
                    </div>
                </div>
            </div>

            <!-- Lista de Equipamentos -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden mb-4">
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-gray-500 dark:text-gray-400 mr-2">
                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                        <path d="M7 7h.01" />
                        <path d="M10.05 7.05h5.9v5.9h-5.9z" />
                        <path d="M7 13h.01" />
                        <path d="M7 17h.01" />
                        <path d="M13 17h4" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Resultados</span>
                </div>
                <div id="lista-equipamentos" class="max-h-96 overflow-y-auto bg-white dark:bg-gray-800" onscroll="verificarScroll()">
                    <!-- Os equipamentos serão carregados aqui via JavaScript -->
                </div>
            </div>

            <!-- Botões do Modal -->
            <div class="flex justify-end">
                <button
                    onclick="fecharModalEquipamentos()"
                    class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200"
                >
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Additional dark mode color for slightly lighter than gray-700 */
        .dark .dark\:bg-gray-750 {
            background-color: rgba(55, 65, 81, 0.8);
        }
        
        /* Hover effect for dark mode table rows */
        .dark .dark\:hover\:bg-gray-750:hover {
            background-color: rgba(55, 65, 81, 0.5);
        }
        
        /* Equipment item styling */
        .equipment-item {
            @apply p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750 cursor-pointer transition-colors duration-150 flex items-center;
        }
        
        .equipment-item:last-child {
            @apply border-b-0;
        }
    </style>

    <!-- Scripts -->
    <script>
        let paginaAtual = 1;
        let carregando = false;

        function abrirModalEquipamentos() {
            const modal = document.getElementById('modal-equipamentos');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Animate modal appearance
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            
            paginaAtual = 1; // Reinicia a paginação
            document.getElementById('lista-equipamentos').innerHTML = ''; // Limpa a lista
            carregarEquipamentos();
        }

        function fecharModalEquipamentos() {
            // Animate modal disappearance
            const modal = document.getElementById('modal-equipamentos');
            const modalContent = document.getElementById('modalContent');
            
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        function carregarEquipamentos() {
            if (carregando) return;
            carregando = true;
            
            // Mostrar indicador de carregamento
            const listaEquipamentos = document.getElementById('lista-equipamentos');
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'p-4 text-center text-gray-500 dark:text-gray-400';
            loadingIndicator.id = 'loading-indicator';
            loadingIndicator.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Carregando equipamentos...
            `;
            
            if (paginaAtual === 1) {
                listaEquipamentos.innerHTML = '';
            }
            
            listaEquipamentos.appendChild(loadingIndicator);

            const filtroNumeroSerie = document.getElementById('filtro-numero-serie').value;
            const filtroTipo = document.getElementById('filtro-tipo').value;
            const filtroTipoPropriedade = document.getElementById('filtro-tipo-propriedade').value;
            const filtroStatus = document.getElementById('filtro-status').value;
            const filtroSecretaria = document.getElementById('filtro-secretaria').value;

            fetch(`/equipamentos/filtrar?numero_serie=${filtroNumeroSerie}&tipo_id=${filtroTipo}&tipo_propriedade=${filtroTipoPropriedade}&status=${filtroStatus}&secretaria_id=${filtroSecretaria}&page=${paginaAtual}`)
                .then(response => response.json())
                .then(data => {
                    // Remover indicador de carregamento
                    const loadingIndicator = document.getElementById('loading-indicator');
                    if (loadingIndicator) {
                        loadingIndicator.remove();
                    }
                    
                    console.log(data);
;                    if (data.data.length === 0 && paginaAtual === 1) {
                        // Mostrar mensagem de nenhum resultado
                        const emptyState = document.createElement('div');
                        emptyState.className = 'p-8 text-center text-gray-500 dark:text-gray-400';
                        emptyState.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                class="mx-auto mb-4">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                <line x1="8" x2="16" y1="12" y2="12" />
                            </svg>
                            <p class="text-lg font-medium">Nenhum equipamento encontrado</p>
                            <p class="mt-1 text-sm">Tente ajustar os filtros de busca</p>
                        `;
                        listaEquipamentos.appendChild(emptyState);
                    } else {
                        data.data.forEach(equipamento => {
                            const item = document.createElement('div');
                            item.className = 'equipment-item';
                            
                            // Determinar o ícone de status
                            let statusIcon = '';
                            let statusClass = '';
                            
                            switch(equipamento.status) {
                                case 'estoque':
                                    statusIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M20 9v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 2h6a2 2 0 0 1 2 2v5H7V4a2 2 0 0 1 2-2z"/></svg>';
                                    statusClass = 'text-green-600 dark:text-green-400';
                                    break;
                                case 'em_uso':
                                    statusIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12  stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 12"/></svg>';
                                    statusClass = 'text-purple-600 dark:text-purple-400';
                                    break;
                              
                            }
                            
                            item.innerHTML = `
                                <div class="flex-1 flex-row  ml-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700" >
                                    <div class="font-medium text-gray-800 dark:text-gray-100">${equipamento.numero_serie}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">${equipamento.modelo}</div>
                                </div>
                                <div class="flex ml-2 mb-2 items-center ${statusClass} ">
                                    ${statusIcon}
                                    <span class="text-sm">${equipamento.tipo ? equipamento.tipo.nome : 'N/A'}</span>
                                </div>
                            `;
                            
                            item.onclick = () => selecionarEquipamento(equipamento);
                            listaEquipamentos.appendChild(item);
                        });
                    }

                    carregando = false;
                    paginaAtual++; // Prepara para carregar a próxima página
                })
                .catch(error => {
                    console.error('Erro ao carregar equipamentos:', error);
                    carregando = false;
                    
                    // Remover indicador de carregamento
                    const loadingIndicator = document.getElementById('loading-indicator');
                    if (loadingIndicator) {
                        loadingIndicator.remove();
                    }
                    
                    // Mostrar mensagem de erro
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'p-4 text-center text-red-500 dark:text-red-400';
                    errorMessage.textContent = 'Erro ao carregar equipamentos. Tente novamente.';
                    listaEquipamentos.appendChild(errorMessage);
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

        document.getElementById('filtro-tipo-propriedade').addEventListener('change', () => {
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
        
        // Close modal when clicking outside
        document.getElementById('modal-equipamentos').addEventListener('click', function(e) {
            if (e.target === this) {
                fecharModalEquipamentos();
            }
        });
    </script>
@endsection