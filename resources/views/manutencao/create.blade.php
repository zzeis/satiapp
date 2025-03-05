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
                    <label for="numero_serie" class="flex items-center align-centertext-sm font-medium text-gray-700 mb-2">
                        <i data-lucide="barcode" class="w-4 h-4 inline-block mr-1"></i>
                        Número de Série
                    </label>
                    <input
                        type="text"
                        name="numero_serie"
                        id="numero_serie"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                        placeholder="Digite o número de série"
                        required
                    >
                </div>

                <!-- Descrição do Problema -->
                <div class="mb-6">
                    <label for="descricao_problema" class="flex items-center align-centertext-sm font-medium text-gray-700 mb-2">
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
                    <label for="observacoes" class=" flex items-center align-center text-sm font-medium text-gray-700 mb-2">
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
            </form>
        </div>
    </div>
@endsection