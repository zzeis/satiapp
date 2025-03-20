@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Gerenciar Usuários</h1>

        <!-- Filtros e Pesquisa -->
        <div class="mb-4">
            <form action="{{ route('users.index') }}" method="GET" class="flex gap-4">
                <select name="status" class="p-2 border rounded">
                    <option value="">Todos</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Ativos</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inativos</option>
                </select>
                <input type="text" name="search" placeholder="Pesquisar por nome" value="{{ request('search') }}"
                    class="p-2 border rounded">
                <button type="submit" class="p-2 bg-blue-500 text-white rounded">Filtrar</button>
            </form>
        </div>

        <!-- Tabela de Usuários -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Nível</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $user->name  }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">
                                <span class="{{ $user->status ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $user->status ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('users.updateLevel', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="nivel" onchange="this.form.submit()" class="p-1 border rounded">
                                        <option value="1" {{ $user->nivel == 1 ? 'selected' : '' }}>Técnico</option>
                                        <option value="2" {{ $user->nivel == 2 ? 'selected' : '' }}>Gerenciador
                                        </option>
                                        <option value="3" {{ $user->nivel == 3 ? 'selected' : '' }}>Administrador
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('users.updateStatus', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="p-1 {{ $user->status ? 'bg-red-500' : 'bg-green-500' }} text-white rounded">
                                        {{ $user->status ? 'Desativar' : 'Ativar' }}
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
            {{ $users->links() }}
        </div>
    </div>
@endsection
