<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satiapp - Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .brand-blue {
            background-color: #013e91;
        }
        
        .custom-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .btn-hover {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-hover:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.5s ease;
            z-index: -1;
        }
        
        .btn-hover:hover:after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .welcome-animation {
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
    <div class="card-hover custom-shadow bg-white rounded-xl overflow-hidden max-w-4xl w-full flex flex-col md:flex-row welcome-animation">
        <!-- Bloco do Logo -->
        <div class="brand-blue p-10 flex flex-col items-center justify-center md:w-1/2 relative">
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="w-40 h-40 rounded-full bg-white/10 absolute -top-20 -left-20"></div>
                <div class="w-32 h-32 rounded-full bg-white/10 absolute bottom-10 right-10"></div>
            </div>
            
            <img src="{{ asset('images/LogoSATI.png') }}" alt="Logo" class="h-40 w-auto relative z-10 mb-6">
            
            <div class="text-white text-center relative z-10">
                <h2 class="text-xl font-light mb-1">Bem-vindo ao</h2>
                <h1 class="text-3xl font-bold tracking-wider">SATI.APP</h1>
                <p class="mt-4 text-white/80 text-sm">Sistema de Tecnologia e Informação</p>
            </div>
        </div>

        <!-- Bloco dos Botões -->
        <div class="p-10 flex flex-col items-center justify-center md:w-1/2 bg-gradient-to-br from-white to-gray-50">
            <div class="w-full max-w-xs">
                <h1 class="text-3xl font-bold mb-2 text-gray-800">Sati.APP</h1>
                <p class="text-gray-500 mb-8 text-sm">Gestão, Tecnologia e Informação</p>

                <div class="space-y-4 w-full">
                    <!-- Botão de Login -->
                    <a href="{{ route('login') }}" class="btn-hover block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg font-medium tracking-wide hover:from-blue-700 hover:to-blue-800 transition duration-300 text-center shadow-md">
                        Entrar
                    </a>

                    <!-- Botão de Registro -->
                    <a href="{{ route('register') }}" class="btn-hover block w-full bg-gradient-to-r from-gray-700 to-gray-800 text-white py-3 px-4 rounded-lg font-medium tracking-wide hover:from-gray-800 hover:to-gray-900 transition duration-300 text-center shadow-md">
                        Criar Conta
                    </a>
                </div>

                <!-- Link para ir direto ao Login -->
                <p class="text-gray-500 mt-6 text-center text-sm">
                    Já tem uma conta? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">Faça login</a>
                </p>
                
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SATI. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>