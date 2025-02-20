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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
                        <select name="tipo" id="tipo_equipamento_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Selecione um tipo</option>
                            @foreach ($tiposEquipamento as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('tipo', $equipamento->tipo) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Coluna 2: Localização e Responsável -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold mb-2">Localização e Responsável</h2>

                    <!-- Secretaria -->
                    <div>
                        <label for="secretaria_id" class="block text-sm font-medium text-gray-700">Secretaria</label>
                        <select name="secretaria_id" id="secretaria_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Selecione uma secretaria</option>
                            @foreach ($secretarias as $secretaria)
                                <option value="{{ $secretaria->id }}"
                                    {{ old('secretaria_id', $equipamento->secretaria_id) == $secretaria->id ? 'selected' : '' }}>
                                    {{ $secretaria->sigla }} - {{ $secretaria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Responsável -->
                    <div>
                        <label for="responsavel_id" class="block text-sm font-medium text-gray-700">Responsável</label>
                        <select name="responsavel_id" id="responsavel_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecione um responsável</option>
                            @foreach ($pessoas as $pessoa)
                                <option value="{{ $pessoa->id }}"
                                    {{ old('responsavel_id', $equipamento->responsavel_id) == $pessoa->id ? 'selected' : '' }}>
                                    {{ $pessoa->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Coluna 3: Datas e Status -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold mb-2">Datas e Status</h2>

                    <!-- Data de Entrada -->
                    <div>

                        <label for="data_entrada" class="block text-sm font-medium text-gray-700">Data de Chegada</label>
                        <input type="date" name="data_entrada" id="data_entrada"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('data_entrada', $equipamento->data_chegada ? $equipamento->data_chegada->format('Y-m-d') : '') }}"
                            </div>
                        <!-- Data de Saída -->
                        <div>
                            <label for="data_saida" class="block text-sm font-medium text-gray-700">Data de Saída</label>
                            <input type="date" name="data_saida" id="data_saida"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('data_saida', $equipamento->data_saida ? $equipamento->data_saida->format('Y-m-d') : '') }}">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">Selecione o status</option>
                                <option value="manutencao"
                                    {{ old('status', $equipamento->status) == 'manutencao' ? 'selected' : '' }}>Manutenção
                                </option>
                                <option value="em_uso"
                                    {{ old('status', $equipamento->status) == 'em_uso' ? 'selected' : '' }}>
                                    Em Uso</option>
                                <option value="estoque"
                                    {{ old('status', $equipamento->status) == 'estoque' ? 'selected' : '' }}>Estoque
                                </option>
                                <option value="descartado"
                                    {{ old('status', $equipamento->status) == 'descartado' ? 'selected' : '' }}>Descartado
                                </option>
                            </select>
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
