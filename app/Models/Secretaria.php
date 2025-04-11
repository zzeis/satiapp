<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;


    // Relacionamento com Pessoas
    public function pessoas()
    {
        return $this->hasMany(Pessoa::class);
    }

    // Relacionamento com TermoEntrega
    public function termosEntrega()
    {
        return $this->hasMany(TermoEntrega::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }

    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class);
    }
    // Relacionamento para obter a última manutenção
    public function ultimaManutencao()
    {
        return $this->hasOne(Manutencao::class)->latestOfMany();
    }

    // Para contar computadores (se precisar de um escopo específico)
    public function computadores()
    {
        return $this->hasMany(Equipamento::class)->where('tipo_id', 1); // ID 1 = computadores
    }
}
