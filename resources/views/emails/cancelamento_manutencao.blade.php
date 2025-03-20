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
            <h3>Cancelamento de Manutenção</h1>
        </div>
        <div class="content">
            <p>Prefeitura de Iguape,</p>
            <p>Por favor cancelar esta manutenção. Abaixo estão os detalhes:</p>
            <ul>
                <li><strong>ID da Manutenção:</strong> {{ $manutencao->id }}</li>
                <li><strong>Numero de serie:</strong> {{ $manutencao->equipamento->numero_serie }}</li>
                <li><strong>Modelo:</strong> {{ $manutencao->equipamento->modelo }}</li>
                <li><strong>Data de Abertura:</strong>
                    {{ \Carbon\Carbon::parse($manutencao->data_abertura)->format('d/m/Y') }}</li>
            </ul>



        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Prefeitura de Iguape - SatiApp. Todos os direitos reservados.</p>
        </div>
    </div>
</body>

</html>
