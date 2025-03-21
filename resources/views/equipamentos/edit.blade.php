@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="text-white">
                        <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                        <path d="M16 2v5" />
                        <path d="M8 2v5" />
                        <path d="M12 14v3" />
                        <path d="M2 10h20" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white">Editar Equipamento</h3>
                </div>
                
                
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 md:p-8">
            <!-- Mensagens de Erro e Sucesso -->
            @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="mr-2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" x2="12" y1="8" y2="12" />
                        <line x1="12" x2="12.01" y1="16" y2="16" />
                    </svg>
                    <span class="font-medium">Por favor, corrija os seguintes erros:</span>
                </div>
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/30 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="mr-2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Coluna 1: Informações do Equipamento -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="text-blue-500 dark:text-blue-400 mr-2">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                    <path d="M16 2v5" />
                                    <path d="M8 2v5" />
                                    <path d="M12 14v3" />
                                    <path d="M2 10h20" />
                                </svg>
                                Informações do Equipamento
                            </h4>

                            <div class="space-y-5">
                                <!-- Número de Série -->
                                <div class="group">
                                    <label for="numero_serie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        Número de Série
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="text-gray-500 dark:text-gray-400">
                                                <path d="M4 7V4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H6a2 2 0 0 0-2 2v3" />
                                                <path d="M2 14h12" />
                                                <path d="m9 18 3-3-3-3" />
                                            </svg>
                                        </div>
                                        <input type="text" id="numero_serie" name="numero_serie" 
                                            class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                            value="{{ old('numero_serie', $equipamento->numero_serie) }}" required>
                                    </div>
                                    @error('numero_serie')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Modelo -->
                                <div class="group">
                                    <label for="modelo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        Modelo
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="text-gray-500 dark:text-gray-400">
                                                <rect width="18" height="10" x="3" y="11" rx="2" />
                                                <circle cx="12" cy="5" r="2" />
                                                <path d="M12 7v4" />
                                                <line x1="8" x2="16" y1="16" y2="16" />
                                            </svg>
                                        </div>
                                        <input type="text" id="modelo" name="modelo" 
                                            class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                            value="{{ old('modelo', $equipamento->modelo) }}" required>
                                    </div>
                                    @error('modelo')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tipo de Equipamento -->
                                <div class="group">
                                    <label for="tipo_equipamento_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        Tipo de Equipamento
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="text-gray-500 dark:text-gray-400">
                                                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z" />
                                                <line x1="16" x2="2" y1="8" y2="22" />
                                                <line x1="17.5" x2="9" y1="15" y2="15" />
                                            </svg>
                                        </div>
                                        <select id="tipo_equipamento_id" name="tipo_id" 
                                            class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none"
                                            required>
                                            <option value="">Selecione um tipo</option>
                                            @foreach ($tiposEquipamento as $tipo)
                                                <option value="{{ $tipo->id }}" {{ old('tipo_id', $equipamento->tipo->id) == $tipo->id ? 'selected' : '' }}>
                                                    {{ $tipo->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700 dark:text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m6 9 6 6 6-6" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('tipo_id')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna 2: Datas e Status -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-750 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="text-blue-500 dark:text-blue-400 mr-2">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                    <line x1="16" x2="16" y1="2" y2="6" />
                                    <line x1="8" x2="8" y1="2" y2="6" />
                                    <line x1="3" x2="21" y1="10" y2="10" />
                                </svg>
                                Datas
                            </h4>

                            <div class="space-y-5">
                                <!-- Data de Chegada -->
                                <div class="group">
                                    <label for="data_entrada" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        Data de Chegada
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="text-gray-500 dark:text-gray-400">
                                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                                <line x1="16" x2="16" y1="2" y2="6" />
                                                <line x1="8" x2="8" y1="2" y2="6" />
                                                <line x1="3" x2="21" y1="10" y2="10" />
                                                <path d="M8 14h.01" />
                                                <path d="M12 14h.01" />
                                                <path d="M16 14h.01" />
                                                <path d="M8 18h.01" />
                                                <path d="M12 18h.01" />
                                                <path d="M16 18h.01" />
                                            </svg>
                                        </div>
                                        <input type="date" id="data_entrada" name="data_entrada" 
                                            class="block w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 dark:bg-gray-700 dark:text-gray-200"
                                            value="{{ old('data_entrada', $equipamento->data_chegada ? $equipamento->data_chegada->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('data_entrada')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Informações do Sistema -->
                                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Informações do Sistema</h5>
                                    
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600 dark:text-gray-400">Criado em:</span>
                                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ $equipamento->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600 dark:text-gray-400">Última atualização:</span>
                                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ $equipamento->updated_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Equipamento Preview -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-6 border border-blue-100 dark:border-blue-800/30 shadow-sm">
                            <div class="flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" 
                                    class="text-blue-500 dark:text-blue-400">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                    <path d="M16 2v5" />
                                    <path d="M8 2v5" />
                                    <path d="M12 14v3" />
                                    <path d="M2 10h20" />
                                </svg>
                            </div>
                            
                            <div class="text-center">
                                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">
                                    {{ $equipamento->tipo->nome }}
                                </h5>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    {{ $equipamento->modelo }}
                                </p>
                                <div class="inline-block bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ $equipamento->numero_serie }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-wrap justify-between items-center mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('equipamentos.index') }}"
                        class="flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200 mb-2 sm:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                            class="mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Cancelar
                    </a>
                    
                    <div class="flex space-x-3">
                        <button type="submit"
                            class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:translate-y-[-2px] active:translate-y-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="mr-2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Atualizar Equipamento
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
  /* Additional dark mode color for slightly lighter than gray-700 */
  .dark .dark\:bg-gray-750 {
      background-color: rgba(55, 65, 81, 0.5);
  }
</style>
@endsection

