@extends('layouts.app')

@section('title', 'Equipamentos')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Título e Botão de Cadastro -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Equipamentos</h1>
            <a href="{{ route('equipamentos.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
                <i data-lucide="circle-plus" class="mr-2"></i> Cadastrar Equipamento
            </a>
        </div>
        <!-- Filtros e Pesquisa -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form action="{{ route('equipamentos.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Filtro por Secretaria -->
                    <div>
                        <label for="secretaria" class="block text-sm font-medium text-gray-700">Secretaria</label>
                        <select name="secretaria" id="secretaria"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todas</option>
                            @foreach ($secretarias as $secretaria)
                                <option value="{{ $secretaria->id }}"
                                    {{ request('secretaria') == $secretaria->id ? 'selected' : '' }}>
                                    {{ $secretaria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todos</option>
                            <option value="estoque" {{ request('estoque') === 'estoque' ? 'selected' : '' }}>Estoque
                            </option>
                            <option value="em_uso" {{ request('em_uso') === 'em_uso' ? 'selected' : '' }}>Em uso</option>
                        </select>
                    </div>

                    <!-- Campo de Pesquisa -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Pesquisar</label>
                        <input type="text" name="search" id="search"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Número de série, Modelo" value="{{ request('search') }}">
                    </div>

                    <!-- Botão de Pesquisa -->
                    <div class="self-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Tabela de Equipamentos -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Nº Série</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Modelo</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($equipamentos as $equipamento)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class=" text-center px-6 py-4 text-sm text-gray-700"><a class="text-blue-500"
                                    href="{{ route('equipamentos.detalhes', $equipamento->id) }}">
                                    {{ $equipamento->numero_serie }}</a></td>
                            <td class="text-center px-6 py-4 text-sm text-gray-700">{{ $equipamento->modelo }}</td>
                            <td class=" text-center px-6 py-4 text-sm">
                                @php
                                    $statusClasses = [
                                        'estoque' => 'bg-blue-100 text-blue-800',
                                        'em_uso' => 'bg-green-100 text-green-800',
                                        'manutencao' => 'bg-yellow-100 text-yellow-800',
                                    ];
                                    $statusTexts = [
                                        'estoque' => 'Estoque',
                                        'em_uso' => 'Em Uso',
                                        'manutencao' => 'Em Manutenção',
                                    ];
                                @endphp
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClasses[$equipamento->status] }}">
                                    {{ $statusTexts[$equipamento->status] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center space-x-4">
                                    <a href="{{ route('equipamentos.edit', $equipamento->id) }}"
                                        class="text-blue-500 hover:text-blue-700 transition duration-300 flex items-center">
                                        <i data-lucide="pencil" class="mr-1"></i>
                                    </a>
                                    <a class="text-blue-500" href="{{ route('equipamentos.detalhes', $equipamento->id) }}">
                                        <i class="text-blue-600" data-lucide="receipt-text"></i>

                                       </a>
                                    
                                    <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition duration-300 flex items-center"
                                            onclick="return confirm('Tem certeza que deseja excluir este equipamento?')">
                                            <i data-lucide="trash-2" class="mr-1"></i></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $equipamentos->links() }}
        </div>
    </div>
@endsection
