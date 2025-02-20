<?php

namespace App\Models;

use App\Models\Equipamento;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasUlids, SoftDeletes;

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
}
