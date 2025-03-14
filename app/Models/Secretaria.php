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
       

}


