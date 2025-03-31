<?php

namespace App\Models;

use App\Models\Manutencao;
use App\Models\Pessoa;
use App\Models\Secretaria;
use App\Models\TermoEntrega;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipamento extends Model
{
    use HasUlids, SoftDeletes;

    protected $primaryKey = 'id'; // UUID como chave primária
    protected $keyType = 'string'; // Tipo da chave primária
    public $incrementing = false; // Desabilita o auto-incremento
    protected $fillable = [
        'secretaria_id',
        'responsavel_id',
        'status',
        'tipo_id',
        'numero_serie',
        'modelo',
        'local',
        'user_id',
        'especificacoes',
        'data_chegada',
        'data_ultima_manutencao',
        'tipo_propriedade'
    ];

    protected $casts = [
        'data_chegada' => 'date',
        'data_ultima_manutencao' => 'datetime',
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }

    public function responsavel()
    {
        return $this->belongsTo(Pessoa::class, 'responsavel_id');
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacoes::class, 'equipamento_id');
    }


    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class, 'equipamento_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoEquipamento::class, 'tipo_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($equipamento) {
            $equipamento->user_id = auth()->id();
        });
    }

    /**
     * Mutator para o campo "modelo".
     * Converte o valor para maiúsculas antes de salvar no banco de dados.
     *
     * @param string $value
     */
    public function setModeloAttribute($value)
    {
        $this->attributes['modelo'] = strtoupper($value);
    }

    public function setNumeroSerieAttribute($value)
    {
        $this->attributes['numero_serie'] = strtoupper($value);
    }

    public function termos()
    {
        return $this->belongsToMany(TermoEntrega::class, 'termo_equipamentos', 'equipamento_id', 'termo_id')
            ->withPivot('quantidade') // Adiciona a coluna 'quantidade' ao relacionamento
            ->withTimestamps(); // Adiciona os timestamps ao relacionamento
    }

    public function anotacoes()
    {
        return $this->hasMany(Anotacao::class, 'id_equipamento');
    }
}
