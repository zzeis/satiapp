<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermoEntrega extends Model
{
    use HasUlids;

    protected $keyType = 'string';
    protected $fillable = [
        'arquivo_path',
        'data_entrega',
        'observacoes',
        'responsavel_id',
        'secretaria_id',
        'user_id',
        'data_devolucao',
        'user_devolucao_id',
        'observacoes',
        'status',
        'processado'

    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }

    public function responsavel()
    {
        return $this->belongsTo(Pessoa::class, 'responsavel_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function equipamentos()
    {
        return $this->belongsToMany(Equipamento::class, 'termo_equipamentos', 'termo_id', 'equipamento_id')
            ->withPivot('quantidade') // Adiciona a coluna 'quantidade' ao relacionamento
            ->withTimestamps(); // Adiciona os timestamps ao relacionamento
    }

    public function usuarioDevolucao()
    {
        return $this->belongsTo(User::class, 'user_devolucao_id');
    }
    public function anotacoes()
    {
        return $this->hasMany(Anotacao::class, 'id_termoEntrega');
    }
}
