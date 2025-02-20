<?php

namespace App\Models;

use Equipamento;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermoEntrega extends Model
{
    use HasUlids;

    protected $fillable = [
        'arquivo_path',
        'data_entrega',
        'observacoes'
    ];

    public function equipamento() {
        return $this->belongsTo(Equipamento::class);
    }

    public function responsavel() {
        return $this->belongsTo(Pessoa::class, 'responsavel_id');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }
}