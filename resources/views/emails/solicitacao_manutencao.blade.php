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