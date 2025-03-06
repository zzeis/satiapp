<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEquipamentosTableSeeder extends Seeder
{
    public function run(): void
    {
        $tipos_equipamentos = [
            ['id' => 1, 'nome' => 'DESKTOP'],
            ['id' => 2, 'nome' => 'MONITOR'],
            ['id' => 3, 'nome' => 'ESTABILIZADOR'],
            ['id' => 4, 'nome' => 'MOUSE'],
            ['id' => 5, 'nome' => 'TECLADO'],
            ['id' => 6, 'nome' => 'IMPRESSORA'],
            ['id' => 7, 'nome' => 'NOTEBOOK'],
            ['id' => 8, 'nome' => 'TABLET'],
        ];

        // Limpa a tabela antes de inserir
        DB::table('tipos_equipamentos')->truncate();

        // Insere os dados
        DB::table('tipos_equipamentos')->insert($tipos_equipamentos);
    }
}