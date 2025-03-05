<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Manutenção</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        body {

            font-family: "Roboto", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }

        .header {
            background-color: #f3f4f6;
            color: #898686;
            padding: 20px;
            text-align: center;
        }

        .header img {
            max-width: 80px;
            max-height: 80px;
        }

        .content {
            padding: 20px;
        }

        .footer {
            background-color: #f3f4f6;
            color: #898686;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="header">
            <img src="{{ $message->embed(public_path('images/LogoSATI.png')) }}">
            <h3>Solicitação de Manutenção</h1>
        </div>
        <div class="content">
            <p>Por favor, solicitamos a manutenção para o seguinte equipamento:</p>
            <ul>
                <li><strong>Tipo:</strong> {{ $manutencao->equipamento->tipo->nome }}</li>
                <li><strong>Modelo:</strong> {{ $manutencao->equipamento->modelo }}</li>
                <li><strong>N/S:</strong> {{ $manutencao->equipamento->numero_serie }}</li>
                <li><strong>Defeito:</strong> {{ $manutencao->descricao_problema }}</li>
                <li><strong>Secretaria:</strong> {{ $manutencao->secretaria->nome }}</li>
                <li><strong>Local:</strong> {{ $manutencao->local }}</li>
                <li><strong>Observação:</strong> {{ $manutencao->observacoes }}</li>
            </ul>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Prefeitura de Iguape - SatiApp. Todos os direitos reservados.</p>
        </div>
    </div>
</body>

</html>
