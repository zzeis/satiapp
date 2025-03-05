<?php

namespace App\Models;

use App\Models\Equipamento;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use  SoftDeletes, HasUuids;

    protected $keyType = 'string'; 
    protected $fillable = [
        'nome',
        'cpf',
        'cargo',
        
        'secretaria_id'
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class, 'responsavel_id');
    }

     
     // Relacionamento com TermoEntrega
     public function termosEntrega()
     {
         return $this->hasMany(TermoEntrega::class, 'responsavel_id');
     }
     
     // Relacionamento com Equipamentos (onde é responsável)
     public function equipamentosResponsavel()
     {
         return $this->hasMany(Equipamento::class, 'responsavel_id');
     }

      /**
     * Mutator para o campo "modelo".
     * Converte o valor para maiúsculas antes de salvar no banco de dados.
     *
     * @param string $value
     */
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = strtoupper($value);
    }
}
