@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Título com ícone -->
            <div class="flex items-center mb-6">
                <i data-lucide="archive-restore" class="w-8 h-8 text-blue-500 mr-2"></i>
                <h1 class="text-2xl font-bold text-gray-800">Cadastrar Equipamento</h1>
            </div>

            <!-- Mensagens de Erro -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulário -->
            <form action="{{ route('equipamentos.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <!-- Coluna 1: Informações do Equipamento -->
                    <div class="space-y-4">
                        <!-- Número de Série -->
                        <div>
                            <label for="numero_serie" class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <i data-lucide="barcode" class="w-4 h-4 inline-block mr-1"></i>
                                Número de Série
                            </label>
                            <input type="text" name="numero_serie" id="numero_serie"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                required>
                        </div>

                        <!-- Modelo -->
                        <div>
                            <label for="modelo" class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <i data-lucide="box" class="w-4 h-4 inline-block mr-1"></i>
                                Modelo
                            </label>
                            <input type="text" name="modelo" id="modelo"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                required>
                        </div>

                        <!-- Tipo de Equipamento -->
                        <div>
                            <label for="tipo_equipamento_id" class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <i data-lucide="settings" class="w-4 h-4 inline-block mr-1"></i>
                                Tipo de Equipamento
                            </label>
                            <select name="tipo_id" id="tipo_equipamento_id"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                required>
                                <option value="">Selecione um tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Coluna 2: Datas e Status -->
                    <div class="space-y-4">
                      

                        <!-- Data de Chegada -->
                        <div>
                            <label for="data_chegada" class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <i data-lucide="calendar-days" class="w-4 h-4 inline-block mr-1"></i>
                                Data de Chegada
                            </label>
                            <input type="date" name="data_chegada" id="data_chegada"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                required>
                        </div>

                     
                    </div>
                </div>

                <!-- Hidden input for SATI secretaria ID -->
                <input type="hidden" name="sati_secretaria_id" value="9">

                <!-- Botão de Envio -->
                <div class="mt-6 flex justify-end items-right">
                    <button type="submit"
                        class="flex items-center bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelect = document.getElementById('status');
                const responsavelContainer = document.getElementById('responsavel_container');
                const dataSaidaContainer = document.getElementById('data_saida_container');
                const secretariaSelect = document.getElementById('secretaria_id');
                const satiSecretariaId = "9"; // ID da secretaria SATI

                function handleStatusChange() {
                    const isEstoque = statusSelect.value === 'estoque';

                    // Show/hide responsável and data de saída
                    responsavelContainer.style.display = isEstoque ? 'none' : 'block';
                    dataSaidaContainer.style.display = isEstoque ? 'none' : 'block';

                    // Set secretaria to SATI when status is estoque
                    if (isEstoque) {
                        secretariaSelect.value = satiSecretariaId;
                    } else {
                        secretariaSelect.disabled = false;
                    }
                }

                // Initial check
                handleStatusChange();

                // Listen for changes
                statusSelect.addEventListener('change', handleStatusChange);
            });
        </script>
    @endpush
@endsection