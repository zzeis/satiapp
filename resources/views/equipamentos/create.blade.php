@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Cadastrar Equipamento</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('equipamentos.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Coluna 1: Informações do Equipamento -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold mb-2">Informações do Equipamento</h2>

                    <div>
                        <label for="numero_serie" class="block text-sm font-medium text-gray-700">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                        <input type="text" name="modelo" id="modelo"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="tipo_equipamento_id" class="block text-sm font-medium text-gray-700">Tipo de Equipamento</label>
                        <select name="tipo_id" id="tipo_equipamento_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
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
                    <h2 class="text-lg font-semibold mb-2">Datas e Status</h2>

                    <div>
                        <label for="data_chegada" class="block text-sm font-medium text-gray-700">Data de Chegada</label>
                        <input type="date" name="data_chegada" id="data_chegada"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    
                  
                </div>

              
            </div>

            <!-- Hidden input for SATI secretaria ID -->
            <input type="hidden" name="sati_secretaria_id" value="9">

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Cadastrar
                </button>
            </div>
        </form>
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