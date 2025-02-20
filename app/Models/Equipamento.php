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
        'data_ultima_manutencao'
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

    public function termos()
    {
        return $this->hasMany(TermoEntrega::class);
    }

    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class);
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

        static::deleting(function ($equipamento) {
            // Só modifica se for soft delete
            if (!$equipamento->isForceDeleting()) {
                $equipamento->numero_serie = $equipamento->numero_serie . '_deleted_' . time();
                $equipamento->save();
            }
        });
    }

    
}
