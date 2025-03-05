<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermoEquipamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'termo_id',
        'equipamento_id',
        'quantidade',
    ];

    // Relacionamento com a tabela 'termos'
    public function termo()
    {
        return $this->belongsTo(TermoEntrega::class, 'termo_id');
    }

    // Relacionamento com a tabela 'equipamentos'
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }
    
}
