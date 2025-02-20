<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
