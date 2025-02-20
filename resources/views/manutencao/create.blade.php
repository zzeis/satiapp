@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Abrir Chamado de Manutenção</h1>

        <form action="{{ route('manutencao.store') }}" method="POST">
            @csrf

            <!-- Número de Série -->
            <div class="mb-4">
                <label for="numero_serie" class="block text-sm font-medium text-gray-700">Número de Série</label>
                <input
                    type="text"
                    name="numero_serie"
                    id="numero_serie"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    required
                >
            </div>

            <!-- Descrição do Problema -->
            <div class="mb-4">
                <label for="descricao_problema" class="block text-sm font-medium text-gray-700">Descrição do Problema</label>
                <textarea
                    name="descricao_problema"
                    id="descricao_problema"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    required
                ></textarea>
            </div>

            <!-- Local -->
            <div class="mb-4">
                <label for="local" class="block text-sm font-medium text-gray-700">Local</label>
                <input
                    type="text"
                    name="local"
                    id="local"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Observações -->
            <div class="mb-4">
                <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea
                    name="observacoes"
                    id="observacoes"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                ></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Abrir Chamado
            </button>
        </form>
    </div>
@endsection