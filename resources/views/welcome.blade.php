<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satiapp - Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-3xl font-bold mb-4"> SatiaAPP</h1>
        <p class="text-gray-600 mb-8">Gestão Técnologia e Informação</p>

        <div class="space-y-4">
            <!-- Botão de Login -->
            <a href="{{ route('login') }}" class="block w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                Login
            </a>

            <!-- Botão de Registro -->
            <a href="{{ route('register') }}" class="block w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300">
                Registrar
            </a>

            <!-- Link para ir direto ao Login -->
            <p class="text-gray-600 mt-4">
                Já tem uma conta? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Faça login aqui</a>.
            </p>
        </div>
    </div>
</body>
</html>