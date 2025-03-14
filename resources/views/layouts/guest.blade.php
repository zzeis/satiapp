<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .brand-blue {
                background-color: #013e91;
            }
            
            .custom-shadow {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            
            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-100 to-gray-200 ">
            <div class="fixed inset-0 -z-10 overflow-hidden">
                <div class="absolute inset-0 opacity-20">
                    <div class="w-96 h-96 rounded-full bg-blue-500/20 absolute -top-48 -left-48 blur-3xl"></div>
                    <div class="w-96 h-96 rounded-full bg-indigo-500/20 absolute top-1/2 right-1/2 blur-3xl"></div>
                    <div class="w-96 h-96 rounded-full bg-blue-500/20 absolute -bottom-48 -right-48 blur-3xl"></div>
                </div>
            </div>

            <div class="w-32 h-32 flex items-center justify-center brand-blue rounded-2xl custom-shadow mb-6 transform hover:scale-105 transition-transform duration-300">
                <a href="/">
                    <img src="{{ asset('images/LogoSATI.png') }}" alt="Logo" class="w-24 h-24 object-contain">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 glass-effect dark:bg-gray-800/90 custom-shadow sm:rounded-2xl">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} SATI. Todos os direitos reservados.
            </div>
        </div>
    </body>
</html>