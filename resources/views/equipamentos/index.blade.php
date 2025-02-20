@extends('layouts.app')

@section('title', 'Equipamentos')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Equipamentos</h1>

    <a href="{{ route('equipamentos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Cadastrar Equipamento
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nº Série</th>
                    <th class="px-4 py-2">Modelo</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipamentos as $equipamento)
                    <tr>
                        <td class="border px-4 py-2">{{ $equipamento->numero_serie }}</td>
                        <td class="border px-4 py-2">{{ $equipamento->modelo }}</td>
                        <td class="border px-4 py-2">
                            <span
                                class="px-2 py-1 rounded {{ $equipamento->status === 'em_uso' ? 'bg-green-200' : 'bg-yellow-200' }}">
                                {{ $equipamento->status }}
                            </span>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('equipamentos.edit', $equipamento->id) }}"
                                class="text-blue-500 hover:underline mr-2">
                                Editar
                            </a>
                            <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $equipamentos->links() }}
    </div>
@endsection
