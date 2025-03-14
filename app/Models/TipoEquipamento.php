<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEquipamento extends Model
{
    use HasFactory;
    
    protected $table = 'tipos_equipamentos';
    protected $fillable = ['nome'];


    // Relacionamento com Equipamento
    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class, 'tipo_id');
    }
    
}

