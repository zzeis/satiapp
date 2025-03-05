<!-- resources/views/termos/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Cabeçalho -->
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-2xl font-semibold text-white">Termo de Entrega #{{ $termoEntrega->id }}</h3>
            </div>

            <!-- Corpo do Card -->
            <div class="p-6">
                <!-- Dados do Responsável e do Termo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Dados do Responsável -->
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Dados do Responsável</h4>
                        <div class="space-y-3">
                            <p><strong class="text-gray-700">Nome:</strong> <span
                                    class="text-gray-600">{{ $termoEntrega->responsavel->nome }}</span></p>
                            <p><strong class="text-gray-700">CPF:</strong> <span
                                    class="text-gray-600">{{ $termoEntrega->responsavel->cpf }}</span></p>
                            <p><strong class="text-gray-700">Secretaria:</strong> <span
                                    class="text-gray-600">{{ $termoEntrega->secretaria->nome }}</span></p>
                        </div>
                    </div>

                    <!-- Dados do Termo -->
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Dados do Termo</h4>
                        <div class="space-y-3">
                            <p><strong class="text-gray-700">Data de Criação:</strong> <span
                                    class="text-gray-600">{{ $termoEntrega->created_at->format('d/m/Y H:i') }}</span></p>
                            <p><strong class="text-gray-700">Usuário Responsável:</strong> <span
                                    class="text-gray-600">{{ $termoEntrega->usuario->name }}</span></p>
                            @if ($termoEntrega->arquivo_path)
                                <p>
                                    <strong class="text-gray-700">Arquivo:</strong>
                                    <a href="{{ asset($termoEntrega->arquivo_path) }}" target="_blank"
                                        class="text-blue-500 hover:text-blue-700 underline">Visualizar</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Lista de Equipamentos -->
                <div class="mb-8">
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Equipamentos</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tipo</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Modelo</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Número de Série</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($termoEntrega->equipamentos as $equipamento)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $equipamento->tipo->nome }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $equipamento->modelo }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $equipamento->numero_serie }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-sm text-gray-600 text-center">Nenhum
                                            equipamento encontrado para este termo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- devolução -->
                @if ($termoEntrega->observacoes && $termoEntrega->status == false)
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Devolução</h4>
                        <p class="mb-5"> <strong class="text-gray-700">Data de devolução:</strong> {{ \Carbon\Carbon::parse($termoEntrega->data_devolucao)->format('d/m/Y') }}</p>
                        <p class="mb-5"> <strong class="text-gray-700">Usuário Responsável:</strong> 
                            {{ $termoEntrega->usuarioDevolucao ? $termoEntrega->usuarioDevolucao->name : 'N/A' }}
                        </p>

                        <p> <strong class="text-gray-700">Observações:</strong> {{ $termoEntrega->observacoes }}</p>



                    </div>
                  

                   
                @endif

                <!-- Botões de Ação -->
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('termo.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300">Voltar</a>
                    <button type="button" onclick="window.print()"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
@endsection
