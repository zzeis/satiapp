<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manutencao extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'equipamento_id',
        'user_id',
        'secretaria_id',
        'local',
        'descricao_problema',
        'status',
        'data_abertura',
        'data_visita',
        'data_conclusao',
        'observacoes',
        'equipamento_novo_id',
        'dados_equipamento_antigo'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }
    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacoes::class);
    }

    public function equipamentoNovo()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_novo_id');
    }

    public function anotacoes()
    {
        return $this->hasMany(Anotacao::class, 'id_manutencao');
    }



    public function getEquipamentoInfoAttribute()
    {
        if ($this->equipamento) {
            return [
                'numero_serie' => $this->equipamento->numero_serie,
                'modelo' => $this->equipamento->modelo,
                'tipo' => optional($this->equipamento->tipo)->nome
            ];
        } elseif ($this->dados_equipamento_antigo) {
            $dados = json_decode($this->dados_equipamento_antigo, true);
            return [
                'numero_serie' => $dados['numero_serie'] ?? 'N/A',
                'modelo' => $dados['modelo'] ?? 'N/A',
                'tipo' => $dados['tipo_nome'] ?? 'N/A'
            ];
        } else {
            return [
                'numero_serie' => 'Equipamento indisponível',
                'modelo' => 'Equipamento indisponível',
                'tipo' => 'N/A'
            ];
        }
    }
}
