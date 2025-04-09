@extends('layouts.app')

@section('title', 'Termo de Entrega')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <!-- Header with Title and Action Button -->
            <div class="flex flex-col md:flex-row justify-between items-center p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-blue-500 dark:text-blue-400">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" x2="8" y1="13" y2="13" />
                        <line x1="16" x2="8" y1="17" y2="17" />
                        <line x1="10" x2="8" y1="9" y2="9" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Termos de Entrega</h1>
                </div>
                <a href="{{ route('termo.create') }}"
                    class="mt-4 md:mt-0 inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:translate-y-[-1px] active:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Criar Novo Termo
                </a>
            </div>

            <!-- Filtros e Pesquisa -->
            <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                <form action="{{ route('termo.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Filtro por Secretaria -->
                        <div class="group">
                            <label for="secretaria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Secretaria
                            </label>
                            <div class="relative">
                                <select name="secretaria" id="secretaria"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todas</option>
                                    @foreach ($secretarias as $secretaria)
                                        <option value="{{ $secretaria->id }}"
                                            {{ request('secretaria') == $secretaria->id ? 'selected' : '' }}>
                                            {{ $secretaria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro por Status -->
                        <div class="group">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Status
                            </label>
                            <div class="relative">
                                <select name="status" id="status"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Devolvido</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Campo de Pesquisa -->
                        <div class="group">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                Pesquisar
                            </label>
                            <div class="relative">
                                <input type="text" name="search" id="search"
                                    class="block w-full px-4 py-3 pl-10 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                    placeholder="Número de série, nome ou CPF" value="{{ request('search') }}">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Botão de Pesquisa -->
                        <div class="self-end">
                            <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-5 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors duration-300 shadow-sm hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M3 6h18" />
                                    <path d="M7 12h10" />
                                    <path d="M10 18h4" />
                                </svg>
                                Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Contador de resultados -->
            <div class="px-6 pt-4 pb-2 flex items-center text-sm text-gray-600 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" x2="8" y1="13" y2="13" />
                    <line x1="16" x2="8" y1="17" y2="17" />
                    <line x1="10" x2="8" y1="9" y2="9" />
                </svg>
                <span>Exibindo <span class="font-medium text-gray-800 dark:text-gray-200">{{ $termos->count() }}</span> de <span class="font-medium text-gray-800 dark:text-gray-200">{{ $termos->total() }}</span> termos</span>
            </div>

            <!-- Tabela de Termos de Entrega -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Nome da Pessoa
                            </th>
                            
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Secretaria
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Data de Entrega
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($termos as $termo)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('termo.show', $termo->id) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors duration-200">
                                        {{ $termo->responsavel->nome }}
                                    </a>

                                    <x-anotacoes-indicator 
                                    :anotacoes="$termo->anotacoes"
                                    showCount="false"
                                    iconSize="lg"
                                />
                                </td>
                               
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ $termo->secretaria->nome }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($termo->data_entrega)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($termo->status)
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Ativo
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Devolvido
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('termo.show', $termo->id) }}"
                                           class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200"
                                           title="Visualizar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                                <line x1="8" x2="16" y1="10" y2="10" />
                                                <line x1="8" x2="14" y1="14" y2="14" />
                                                <line x1="8" x2="10" y1="18" y2="18" />
                                            </svg>
                                        </a>
                                        
                                        <!-- Ícone de Devolução -->
                                        @if ($termo->status)
                                            <button onclick="openModal('{{ $termo->id }}')"
                                                class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors duration-200"
                                                title="Registrar Devolução">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 14 4 9l5-5" />
                                                    <path d="M4 9h16" />
                                                    <path d="M15 4v6" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-gray-400">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                            <polyline points="14 2 14 8 20 8" />
                                            <line x1="16" x2="8" y1="13" y2="13" />
                                            <line x1="16" x2="8" y1="17" y2="17" />
                                            <line x1="10" x2="8" y1="9" y2="9" />
                                        </svg>
                                        <span class="text-lg font-medium">Nenhum termo de entrega encontrado</span>
                                        <p class="mt-1 text-sm">Tente ajustar os filtros ou crie um novo termo</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                {{ $termos->links() }}
            </div>
        </div>
    </div>

    <!-- Modal de Devolução -->
    <div id="modal-devolucao" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-md max-h-[80vh] overflow-y-auto mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-yellow-500 dark:text-yellow-400 mr-2">
                        <path d="M9 14 4 9l5-5" />
                        <path d="M4 9h16" />
                        <path d="M15 4v6" />
                    </svg>
                    Registrar Devolução
                </h2>
                <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <form id="form-devolucao" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="termo_id" id="termo_id">
                
                <div class="group">
                    <label for="observacoes_devolucao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                        Observações
                    </label>
                    <textarea name="observacoes_devolucao" id="observacoes_devolucao" rows="4"
                        class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                        placeholder="Digite as observações sobre a devolução"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-sm hover:shadow">
                        Confirmar Devolução
                    </button>
                </div>
            </form>
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
    </style>

    <!-- Script para Controlar o Modal -->
    <script>
        function openModal(termoId) {
            document.getElementById('form-devolucao').action = `/TermoDeEntrega/${termoId}/devolucao`;
            
            // Show modal with animation
            const modal = document.getElementById('modal-devolucao');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Animate modal appearance
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            // Animate modal disappearance
            const modal = document.getElementById('modal-devolucao');
            const modalContent = document.getElementById('modalContent');
            
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        // Close modal when clicking outside
        document.getElementById('modal-devolucao').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });
    </script>
@endsection