@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 px-6 py-5">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="text-white">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white">Gerenciar Usuários</h3>
                </div>
                
                <!-- Stats Summary -->
                <div class="flex flex-wrap gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-1.5 text-white text-sm font-medium">
                        <span>Total: {{ $users->total() }}</span>
                    </div>
                    <div class="bg-green-500/20 backdrop-blur-sm rounded-lg px-3 py-1.5 text-green-50 text-sm font-medium">
                        <span>Ativos: {{ $users->where('status', 1)->count() }}</span>
                    </div>
                    <div class="bg-red-500/20 backdrop-blur-sm rounded-lg px-3 py-1.5 text-red-50 text-sm font-medium">
                        <span>Inativos: {{ $users->where('status', 0)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Filtros e Pesquisa -->
            <div class="mb-6">
                <form action="{{ route('users.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="relative">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select name="status" id="status" class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                            <option value="">Todos</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Ativos</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inativos</option>
                        </select>
                      
                    </div>
                    
                    <div class="relative sm:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pesquisar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="text-gray-400">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" placeholder="Pesquisar por nome ou email" value="{{ request('search') }}" 
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="mr-2">
                                <path d="M21 6H3" />
                                <path d="M10 12H3" />
                                <path d="M10 18H3" />
                                <path d="M17 16l4 4" />
                                <path d="M21 16l-4 4" />
                                <circle cx="17" cy="12" r="3" />
                            </svg>
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabela de Usuários -->
            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nível
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 dark:text-gray-300 font-semibold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">Criado em: {{ $user->created_at->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->status)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" 
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                    class="mr-1">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                    <polyline points="22 4 12 14.01 9 11.01" />
                                                </svg>
                                                Ativo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" 
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                    class="mr-1">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <line x1="15" x2="9" y1="9" y2="15" />
                                                    <line x1="9" x2="15" y1="9" y2="15" />
                                                </svg>
                                                Inativo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        <form action="{{ route('users.updateLevel', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="relative">
                                                <select name="nivel" onchange="this.form.submit()" 
                                                    class="block w-full pl-3 pr-10 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-200 appearance-none">
                                                    <option value="1" {{ $user->nivel == 1 ? 'selected' : '' }}>Técnico</option>
                                                    <option value="2" {{ $user->nivel == 2 ? 'selected' : '' }}>Gerenciador</option>
                                                    <option value="3" {{ $user->nivel == 3 ? 'selected' : '' }}>Administrador</option>
                                                </select>
                                              
                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        <form action="{{ route('users.updateStatus', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm {{ $user->status ? 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-500' : 'text-white bg-green-600 hover:bg-green-700 focus:ring-green-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200">
                                                @if($user->status)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" 
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                        class="mr-1">
                                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                                        <line x1="9" x2="15" y1="9" y2="15" />
                                                        <line x1="15" x2="9" y1="9" y2="15" />
                                                    </svg>
                                                    Desativar
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" 
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                        class="mr-1">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                        <polyline points="22 4 12 14.01 9 11.01" />
                                                    </svg>
                                                    Ativar
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginação -->
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional dark mode color for slightly lighter than gray-700 */
    .dark .dark\:hover\:bg-gray-750:hover {
        background-color: rgba(55, 65, 81, 0.8);
    }
</style>
@endsection

