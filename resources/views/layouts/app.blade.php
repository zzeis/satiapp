<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SatiAPP</title>
    <!-- jQuery via CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
       <!-- Carrega o CSS com Vite -->
       @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-100">
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
</body>
</html>