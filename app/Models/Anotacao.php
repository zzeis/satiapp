<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    use HasFactory;


        
    protected $table = 'anotacoes';
    protected $fillable = [
        'id_equipamento',
        'id_manutencao',
        'id_termoEntrega',
        'anotacao',
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'id_equipamento');
    }

    public function manutencao()
    {
        return $this->belongsTo(Manutencao::class, 'id_manutencao');
    }

    public function termoEntrega()
    {
        return $this->belongsTo(TermoEntrega::class, 'id_termoEntrega');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}