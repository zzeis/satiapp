@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Editar Equipamento</h1>

        <!-- Mensagens de Erro e Sucesso -->
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

        <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Coluna 1: Informações do Equipamento -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold mb-2">Informações do Equipamento</h2>

                    <!-- Número de Série -->
                    <div>
                        <label for="numero_serie" class="block text-sm font-medium text-gray-700">Número de Série</label>
                        <input type="text" name="numero_serie" id="numero_serie"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('numero_serie', $equipamento->numero_serie) }}" required>
                        @error('numero_serie')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Modelo -->
                    <div>
                        <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                        <input type="text" name="modelo" id="modelo"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('modelo', $equipamento->modelo) }}" required>
                    </div>

                    <!-- Tipo de Equipamento -->
                    <div>
                        <label for="tipo_equipamento_id" class="block text-sm font-medium text-gray-700">Tipo de
                            Equipamento</label>
                        <select name="tipo_id" id="tipo_equipamento_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Selecione um tipo</option>
                            @foreach ($tiposEquipamento as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('tipo', $equipamento->tipo->id) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <!-- Coluna 3: Datas e Status -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold mb-2">Data </h2>

                    <!-- Data de Entrada -->
                    <div>

                        <label for="data_entrada" class="block text-sm font-medium text-gray-700">Data de Chegada</label>
                        <input type="date" name="data_entrada" id="data_entrada"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('data_entrada', $equipamento->data_chegada ? $equipamento->data_chegada->format('Y-m-d') : '') }}">
                    </div>

                </div>
            </div>

            <!-- Botão de Envio -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Atualizar
                </button>
            </div>
        </form>
    </div>
@endsection
