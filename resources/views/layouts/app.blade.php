<!DOCTYPE html>
<html lang="pt-BR"  class="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') SATIAPP</title>


     <!-- Script para aplicar o tema antes do carregamento da página -->
     <script>
        // Verifica o tema salvo no localStorage ou a preferência do sistema
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        // Aplica o tema antes que o restante da página seja carregado
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <!-- jQuery via CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
       <!-- Carrega o CSS com Vite -->
       @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-100 dark:bg-gray-900">
      {{-- Inclui o menu de navegação --}}
      @include('layouts.navigation')

    <div class="container mx-auto px-4 py-6">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    
    @stack('scripts')

    <script>
        // Função para alternar entre modo escuro e claro
        function toggleDarkMode() {
            const htmlElement = document.documentElement;
            const isDarkMode = htmlElement.classList.toggle('dark');
            localStorage.theme = isDarkMode ? 'dark' : 'light';
    
            console.log('test');
            // Atualiza os ícones
            updateIcons(isDarkMode);
        }
    
        // Função para atualizar os ícones de sol e lua
        function updateIcons(isDarkMode) {
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
    
            if (isDarkMode) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }
    
        // Verifica o tema salvo no localStorage ou a preferência do sistema
        function applySavedTheme() {
            const savedTheme = localStorage.theme;
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
            if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
                document.documentElement.classList.add('dark');
                updateIcons(true);
            } else {
                document.documentElement.classList.remove('dark');
                updateIcons(false);
            }
        }
    
        // Aplica o tema ao carregar a página
        applySavedTheme();
    </script>
</body>
</html>