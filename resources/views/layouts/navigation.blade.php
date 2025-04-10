<nav x-data="{ open: false }" class="bg-white  border-b dark:border-gray-700 border-gray-100 dark:bg-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- Substitua o logo por uma imagem -->
                        <img src="{{ asset('images/LogoSATI.png') }}" alt="Logo" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i data-lucide="home" class="w-5 h-5 inline-block mr-1"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @auth
                        @if (in_array(auth()->user()->nivel, [2, 3]))
                            <x-nav-link :href="route('dashboard.report')" :active="request()->routeIs('dashboard.report')">
                                <i data-lucide="database" class="w-5 h-5 inline-block mr-1"></i>
                                {{ __('Relatórios') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    @auth
                        @if (in_array(auth()->user()->nivel, [2, 3]))
                            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                                <i data-lucide="user" class="w-5 h-5 inline-block mr-1"></i>
                                {{ __('Usuarios') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    <!-- Equipamentos -->
                    <x-nav-link :href="route('equipamentos.index')" :active="request()->routeIs('equipamentos.*')">
                        <i data-lucide="server" class="w-5 h-5 inline-block mr-1"></i>
                        {{ __('Equipamentos') }}
                    </x-nav-link>

                    <!-- Manutenção -->
                    <x-nav-link :href="route('manutencao.index')" :active="request()->routeIs('manutencao.*')">
                        <i data-lucide="wrench" class="w-5 h-5 inline-block mr-1"></i>
                        {{ __('Manutenção') }}
                    </x-nav-link>

                    <!-- Termo de Entrega -->
                    <x-nav-link :href="route('termo.index')" :active="request()->routeIs('termo.*')">
                        <i data-lucide="file-text" class="w-5 h-5 inline-block mr-1"></i>
                        {{ __('Termo de Entrega') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex gap-2 sm:items-center sm:ms-6">
                <!-- Botão de Alternância de Modo Escuro/Claro -->
                <div class="flex items-center ms-4">
                    <button onclick="toggleDarkMode()"
                        class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Toggle dark mode">
                        <!-- Ícone de sol (modo claro) -->
                        <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Ícone de lua (modo escuro) -->
                        <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block dark:hidden"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                </div>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="45">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  dark:bg-gray-800 dark:text-gray-400 bg-white  hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i data-lucide="user" class="w-4 h-4 inline-block mr-1"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i data-lucide="log-out" class="w-4 h-4 inline-block mr-1"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i data-lucide="home" class="w-5 h-5 inline-block mr-1"></i>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Equipamentos -->
            <x-responsive-nav-link :href="route('equipamentos.index')" :active="request()->routeIs('equipamentos.*')">
                <i data-lucide="server" class="w-5 h-5 inline-block mr-1"></i>
                {{ __('Equipamentos') }}
            </x-responsive-nav-link>

            <!-- Manutenção -->
            <x-responsive-nav-link :href="route('manutencao.index')" :active="request()->routeIs('manutencao.*')">
                <i data-lucide="wrench" class="w-5 h-5 inline-block mr-1"></i>
                {{ __('Manutenção') }}
            </x-responsive-nav-link>

            <!-- Termo de Entrega -->
            <x-responsive-nav-link :href="route('termo.index')" :active="request()->routeIs('termo.*')">
                <i data-lucide="file-text" class="w-5 h-5 inline-block mr-1"></i>
                {{ __('Termo de Entrega') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i data-lucide="user" class="w-4 h-4 inline-block mr-1"></i>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i data-lucide="log-out" class="w-4 h-4 inline-block mr-1"></i>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
