@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Criar Novo Termo de Entrega</h1>

            <form method="POST" action="{{ route('termo.store') }}" id="termForm">
                @csrf

                <!-- Dados do Funcionário -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="employee_name" class="block text-sm font-medium text-gray-700">Nome do Funcionário</label>
                        <input type="text" id="nome" name="nome"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                        <input type="text" id="cpf" name="cpf"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                </div>

                <!-- Departamento -->
                <div class="mb-6">
                    <label for="department" class="block text-sm font-medium text-gray-700">Secretaria</label>
                    <select name="secretaria_id" id="secretaria_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">Selecione uma secretaria</option>
                        @foreach ($secretarias as $secretaria)
                            <option value="{{ $secretaria->id }}">{{ $secretaria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <hr class="mb-6">

                <!-- Equipamentos -->
                <h4 class="text-xl font-semibold mb-4">Equipamentos</h4>
                <div id="equipment-container">
                    <div class="equipment-row mb-6 p-4 border border-gray-200 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Número de Série -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Número de Série</label>
                                <input type="text" name=""
                                    class="serial-number mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o número de série">
                            </div>

                            <input type="hidden" name="equipamento_id[]"
                                class="equipamento-id mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Digite o número de série">


                            <!-- Tipo de Equipamento -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo de Equipamento</label>
                                <input type="text"
                                    class="equipment-type mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    name="tipo_id[]" readonly>
                            </div>

                            <!-- Modelo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input type="text"
                                    class="equipment-model mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    name="modelo[]" readonly>
                            </div>
                        </div>

                        <!-- Botão Remover Equipamento -->
                        <div class="mt-4">
                            <button type="button"
                                class="remove-equipment-btn bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-trash-2">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    <line x1="10" x2="10" y1="11" y2="17" />
                                    <line x1="14" x2="14" y1="11" y2="17" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Botão Adicionar Outro Equipamento -->
                <div class="mb-6">
                    <button type="button" id="add-equipment-btn"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-package-plus">
                            <path d="M16 16h6" />
                            <path d="M19 13v6" />
                            <path
                                d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                            <path d="m7.5 4.27 9 5.15" />
                            <polyline points="3.29 7 12 12 20.71 7" />
                            <line x1="12" x2="12" y1="22" y2="12" />
                        </svg>
                    </button>
                </div>

                <!-- Botões de Ação -->
                <div class="flex space-x-4 justify-end">
                    <button type="submit" class="flex  items-center align-right bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        <i data-lucide="save" class="w-5 h-5 mr-2"></i>

                        Finalizar
                    </button>

                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let equipmentCounter = 0;

            // Adicionar outro equipamento
            $('#add-equipment-btn').click(function() {
                equipmentCounter++;

                const newRow = `
                    <div class="equipment-row mb-6 p-4 border border-gray-200 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Número de Série -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Número de Série</label>
                                <input type="text" class="serial-number mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o número de série">
                            </div>

                            <!-- id equipamento -->
                            <input type="hidden" name="equipamento_id[]"
                                    class="equipamento-id mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o número de série">
                            <!-- Tipo de Equipamento -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo de Equipamento</label>
                                <input type="text" class="equipment-type mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    name="tipo_id[]" readonly>
                            </div>


                            <!-- Modelo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input type="text" class="equipment-model mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    name="equipment_model[]" readonly>
                            </div>
                        </div>

                        <!-- Botão Remover Equipamento -->
                        <div class="mt-4">
                            <button type="button"
                                class="remove-equipment-btn bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </button>
                        </div>
                    </div>
                `;

                $('#equipment-container').append(newRow);
            });

            // Remover equipamento
            $(document).on('click', '.remove-equipment-btn', function() {
                $(this).closest('.equipment-row').remove();
            });

            // Buscar equipamento pelo número de série
            $(document).on('blur', '.serial-number', function() {
                const serialNumber = $(this).val();
                const row = $(this).closest('.equipment-row');

                if (serialNumber) {
                    $.ajax({
                        url: '{{ route('equipamento.buscar-por-serial') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            serial_number: serialNumber
                        },
                        success: function(response) {
                            if (response.equipamento) {
                                // Preenche os campos com os dados do equipamento
                                row.find('.equipment-type').val(response.equipamento.tipo.nome);
                                row.find('.equipamento-id').val(response.equipamento.id);
                                row.find('.equipment-brand').val(response.equipamento.marca);
                                row.find('.equipment-model').val(response.equipamento.modelo);
                            } else {
                                // Exibe mensagem de erro com base no status
                                if (response.status) {
                                    alert(
                                        `Equipamento já está em uso. Status: ${response.status}`
                                    );
                                } else {
                                    alert(response.message); // "Equipamento não encontrado."
                                }
                                row.find('.serial-number').val(
                                    ''); // Limpa o campo de número de série
                            }
                        },
                        error: function() {
                            alert('Erro ao buscar o equipamento.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
