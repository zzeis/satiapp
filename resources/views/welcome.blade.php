<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satiapp - Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row overflow-hidden max-w-4xl w-full">
        <!-- Bloco do Logo -->
        <div class="bg-gray-300 p-8 flex items-center justify-center md:w-1/2">
            <img src="{{ asset('images/LogoSATI.png') }}" alt="Logo" class="h-40 w-auto">
        </div>

        <!-- Bloco dos Botões -->
        <div class="p-8 flex flex-col items-center justify-center md:w-1/2">
            <h1 class="text-3xl font-bold mb-4">SatiaAPP</h1>
            <p class="text-gray-600 mb-8">Gestão, Tecnologia e Informação</p>

            <div class="space-y-4 w-full">
                <!-- Botão de Login -->
                <a href="{{ route('login') }}" class="block w-full bg-gray-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300 text-center">
                    Login
                </a>

                <!-- Botão de Registro -->
                <a href="{{ route('register') }}" class="block w-full bg-gray-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300 text-center">
                    Registrar
                </a>

                <!-- Link para ir direto ao Login -->
                <p class="text-gray-600 mt-4 text-center">
                    Já tem uma conta? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Faça login aqui</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>