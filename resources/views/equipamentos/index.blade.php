@extends('layouts.app')

@section('title', 'Equipamentos')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Título e Botão de Cadastro -->
        <div class="flex justify-between  items-center mb-6 flex-wrap">
            <h1 class="text-2xl font-bold">Equipamentos</h1>
            <a href="{{ route('equipamentos.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus mr-2">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Novo Equipamento
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
                            <option value="estoque" {{ request('status') === 'estoque' ? 'selected' : '' }}>Estoque
                            </option>
                            <option value="em_uso" {{ request('status') === 'em_uso' ? 'selected' : '' }}>Em uso</option>
                            <option value="manutencao" {{ request('status') === 'manutencao' ? 'selected' : '' }}>Em
                                manutenção</option>
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

                    <div class="flex items-end align-center">
                        <button type="submit"
                            class=" bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 min-w-[80px] text-center text-sm">
                            Filtrar
                        </button>
                      
                    </div>
                </div>
            </form>
        </div>

        <!-- Contador de resultados -->
        <div class="mb-4">
            <p class="text-gray-600">Exibindo {{ $equipamentos->count() }} de {{ $equipamentos->total() }} equipamentos
            </p>
        </div>

        <!-- Tabela de Equipamentos -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Nº Série</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Tipo</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Modelo</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($equipamentos as $equipamento)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class=" text-center px-6 py-4 text-sm text-gray-700"><a class="text-blue-500"
                                    href="{{ route('equipamentos.detalhes', $equipamento->id) }}">
                                    {{ $equipamento->numero_serie }}</a></td>
                            <td class="text-center px-6 py-4 text-sm text-gray-700">{{ $equipamento->tipo->nome }}</td>

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
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClasses[$equipamento->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusTexts[$equipamento->status] ?? $equipamento->status }}
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
                                            <i data-lucide="trash-2" class="mr-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Nenhum equipamento encontrado
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $equipamentos->links() }}
        </div>
    </div>
@endsection
