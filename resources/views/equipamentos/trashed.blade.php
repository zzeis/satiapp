@extends('layouts.app')

@section('title', 'Equipamentos Excluídos')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Equipamentos Excluídos</h1>

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
                @foreach($equipamentos as $equipamento)
                    <tr>
                        <td class="border px-4 py-2">{{ $equipamento->numero_serie }}</td>
                        <td class="border px-4 py-2">{{ $equipamento->modelo }}</td>
                        <td class="border px-4 py-2">{{ $equipamento->status }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('equipamentos.restore', $equipamento->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-500 hover:underline mr-2">
                                    Restaurar
                                </button>
                            </form>
                            <form action="{{ route('equipamentos.forceDelete', $equipamento->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">
                                    Excluir Permanentemente
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