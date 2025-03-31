@props([
    'model' => null, // Modelo principal (equipamento, manutencao, termoEntrega)
    'tipo' => 'equipamento', // Tipo de relacionamento
])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-6">
    <div class="border-b border-gray-100 dark:border-gray-700 p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-yellow-500 dark:text-yellow-400 mr-2">
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                    <path d="M9 9h1" />
                    <path d="M9 13h6" />
                    <path d="M9 17h6" />
                </svg>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Anotações</h3>
            </div>
            <!-- Botão para adicionar nova anotação -->
            <button
                onclick="document.getElementById('modal-anotacao-{{ $tipo }}-{{ $model->id }}').classList.remove('hidden')"
                class="inline-flex items-center p-1.5 bg-yellow-100 hover:bg-yellow-200 dark:bg-yellow-700 dark:hover:bg-yellow-600 text-yellow-800 dark:text-yellow-100 rounded-lg transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="p-4">
        @if ($model->anotacoes->isEmpty())
            <div class="flex flex-col items-center justify-center py-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="text-gray-400 dark:text-gray-500 mb-3">
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                    <path d="M9 9h1" />
                    <path d="M9 13h6" />
                    <path d="M9 17h6" />
                </svg>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Nenhuma anotação registrada</p>
            </div>
        @else
            <div class="flex flex-wrap gap-4">
                @foreach ($model->anotacoes as $anotacao)
                    <div class="w-64 transform rotate-1 hover:rotate-0 transition-transform duration-300">
                        <!-- Post-it Note with Shadow and Tape -->
                        <div class="relative group">
                            <!-- Tape at the top -->
                            <div
                                class="absolute -top-2 left-1/2 transform -translate-x-1/2 w-10 h-3 bg-gray-200/70 dark:bg-gray-600/50 rounded-sm rotate-2">
                            </div>

                            <!-- Post-it Note -->
                            <div
                                class="relative bg-gradient-to-br from-yellow-200 to-yellow-100 dark:from-yellow-300/90 dark:to-yellow-200/80 p-3 rounded-sm shadow-md overflow-hidden">
                                <!-- Subtle lined paper effect -->
                                <div class="absolute inset-0 overflow-hidden">
                                    <div class="h-full w-full bg-repeat-y"
                                        style="background-image: linear-gradient(0deg, transparent 24px, rgba(0,0,0,0.05) 25px, transparent 26px); background-size: 100% 30px;">
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="relative z-10">
                                    <div
                                        class="text-yellow-900 dark:text-yellow-950 font-handwriting text-sm leading-relaxed mb-2  max-h-24 overflow-y-auto">
                                        {{$anotacao->anotacao}}</div>
                                    <div class="text-xs text-yellow-800/80 dark:text-yellow-900/90 font-handwriting">
                                        {{ $anotacao->user->name }} - {{ $anotacao->created_at->format('d/m/Y') }}
                                        @if ($anotacao->updated_at->gt($anotacao->created_at))
                                            <br>Editado: {{ $anotacao->updated_at->format('d/m/Y') }}
                                        @endif
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="absolute -top-2 right-1 z-50 mt-3">
                                    <div
                                        class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        @can('update', $anotacao)
                                            <button
                                                onclick="openEditModal('{{ $anotacao->id }}', `{{ $anotacao->anotacao }}`, '{{ $tipo }}')"
                                                class="post-it-button text-yellow-800 hover:text-yellow-950 dark:hover:text-yellow-700 p-2 bg-yellow-50/70 hover:bg-yellow-100/80 dark:bg-yellow-900/30 dark:hover:bg-yellow-900/50 rounded-full transition-colors duration-200 flex items-center justify-center w-8 h-8"
                                                title="Editar anotação">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </button>
                                        @endcan

                                        @can('delete', $anotacao)
                                            <form action="{{ route('anotacoes.destroy', $anotacao) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="post-it-button text-yellow-800 hover:text-yellow-950 dark:hover:text-yellow-700 p-2 bg-yellow-50/70 hover:bg-yellow-100/80 dark:bg-yellow-900/30 dark:hover:bg-yellow-900/50 rounded-full transition-colors duration-200 flex items-center justify-center w-8 h-8"
                                                    title="Excluir anotação"
                                                    onclick="return confirm('Tem certeza que deseja excluir esta anotação?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 6h18"></path>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>

                            <!-- Shadow effect -->
                            <div
                                class="absolute -bottom-1 -right-1 w-full h-full bg-black/5 dark:bg-black/20 rounded-sm -z-10 transform rotate-1">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Modal para editar anotação -->
<div id="modal-edit-anotacao-{{ $tipo }}-{{ $model->id }}"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Editar Anotação</h3>
            <form id="edit-anotacao-form-{{ $tipo }}-{{ $model->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit-anotacao-text-{{ $tipo }}-{{ $model->id }}"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anotação</label>
                    <textarea id="edit-anotacao-text-{{ $tipo }}-{{ $model->id }}" name="anotacao" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        required></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button"
                        onclick="document.getElementById('modal-edit-anotacao-{{ $tipo }}-{{ $model->id }}').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-300">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-300">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para adicionar anotação -->
<div id="modal-anotacao-{{ $tipo }}-{{ $model->id }}"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Adicionar Anotação</h3>
            <form action="{{ route('anotacoes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_{{ $tipo }}" value="{{ $model->id }}">

                <div class="mb-4">
                    <label for="anotacao-{{ $tipo }}-{{ $model->id }}"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anotação</label>
                    <textarea id="anotacao-{{ $tipo }}-{{ $model->id }}" name="anotacao" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        required></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button"
                        onclick="document.getElementById('modal-anotacao-{{ $tipo }}-{{ $model->id }}').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-300">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-300">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>


<script>
    function openEditModal(id, text, tipo) {
        console.log('click');
        const form = document.getElementById(`edit-anotacao-form-${tipo}-{{ $model->id }}`);
        form.action = `/anotacoes/${id}`;
        document.getElementById(`edit-anotacao-text-${tipo}-{{ $model->id }}`).value = text;
        document.getElementById(`modal-edit-anotacao-${tipo}-{{ $model->id }}`).classList.remove('hidden');
    }
</script>
