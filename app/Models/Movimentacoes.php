<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    use HasFactory;
    protected $fillable = [
        'manutencao_id',
        'user_id',
        'acao',
        'data',
        'descricao',
        'equipamento_id',
        'termo_id',
        

    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function manutencao()
    {
        return $this->belongsTo(Manutencao::class);
    }

    public function Termo()
    {
        return $this->belongsTo(TermoEntrega::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movimentacoes) {
            $movimentacoes->user_id = auth()->id();
        });
    }
}
