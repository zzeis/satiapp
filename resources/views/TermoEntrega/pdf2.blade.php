<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Termo de Responsabilidade</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin: 20px 0;
        }
        .identification {
            margin-bottom: 15px;
        }
        .equipment-list {
            margin-left: 20px;
            margin-bottom: 20px;
        }
        .equipment-item {
            margin-bottom: 5px;
        }
        .terms {
            margin-bottom: 20px;
        }
        .terms p {
            margin: 5px 0;
        }
        .signature {
            margin-top: 40px;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 100%;
            margin-top: 50px;
        }
        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: center;
        }
        .return-section {
            margin-top: 50px;
            page-break-before: always;
        }
        .return-options {
            margin-top: 20px;
        }
        .check-box {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid #000;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img width="60" height="60" alt="brasao" src="{{ asset('images/brasao.png') }}"/>
        <h2>MUNICIPIO DE IGUAPE</h2>
        <p>- Estância Balneária -</p>
        <p>SEC. ADJUNTA DE TECNOLOGIA DA INFORMAÇÃO</p>
    </div>

    <div class="title">
        Termo de Responsabilidade pela<br>
        Guarda e Uso de Equipamento
    </div>

    <div class="identification">
        <strong>IDENTIFICAÇÃO DO EMPREGADO</strong><br>
        Nome: , CPF: , , Recebi da empresa: PREFEITURA MUNICIPAL DE IGUAPE, CNPJ 45.550.167/0001-64.
    </div>

    <div class="terms">
        <p>A título de empréstimo, para meu uso exclusivo, os equipamentos especificados neste termo de responsabilidade, comprometendo-me a mantê-los em perfeito estado de conservação, ficando ciente de que:</p>
        <p>1 - Se o equipamento for danificado ou inutilizado por emprego inadequado, mau uso, negligência ou extravio, a empresa me fornecerá novo equipamento e cobrará o valor de um equipamento da mesma marca ou equivalente ao da praça.</p>
        <p>2 - Em caso de dano, inutilização ou extravio do equipamento deverei comunicar imediatamente ao setor competente.</p>
        <p>2.1 - Em caso, furto, roubo ou perda do equipamento, deverá o resposável realizar o BOLETIM DE OCORRÊNCIA imediatamente, bem como comunicar o Superior imediato para às devidas providências.</p>
        <p>3 - Terminando os serviços ou no caso de rescisão do contrato de trabalho, devolverei o equipamento completo e em perfeito estado de conservação, considerando-se o tempo do uso do mesmo, ao setor competente.</p>
        <p>4 - Estando os equipamentos em minha posse, estarei sujeito a inspeções sem prévio aviso.</p>
    </div>

    <div class="equipment-list">
        <strong>PATRIMÔNIO / MARCA / MODELO</strong>
      
        <div class="equipment-item">
            • 1   '– N/S '.$equipamento->numero_serie : '' 
        </div>
     
    </div>

    <div class="signature">
        <p>Iguape/SP, ________ de ___________________ de {{ date('Y') }}.</p>
        <p>Ciente (Nome / Assinatura): ___________________________________________________________</p>
    </div>

    <div class="footer">
        <p>Av. Adhemar de Barros, N°. 1.070, Porto do Ribeira, Fone (13) 3848-6810 – CEP 11920-000 – Iguape – SP.</p>
    </div>

    <div class="return-section">
        <div class="header">
            <h2>MUNICIPIO DE IGUAPE</h2>
            <p>- Estância Balneária -</p>
            <p>SEC. ADJUNTA DE TECNOLOGIA DA INFORMAÇÃO</p>
        </div>

        <div class="title">
            DEVOLUÇÃO
        </div>

        <p>Atestamos que o bem foi devolvido em ___/___/___, nas seguintes condições:</p>
        <div class="return-options">
            <p>(<span class="check-box"></span>) Em perfeito estado (<span class="check-box"></span>) Apresentando defeito (<span class="check-box"></span>) Faltando peças / acessórios.</p>
        </div>

        <div class="signature" style="margin-top: 100px;">
            <span class="signature-line"></span>
            <p>(Data / assinatura / nome do responsável pelo recebimento)</p>
        </div>
    </div>
</body>
</html>