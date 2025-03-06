<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEquipamentosTableSeeder extends Seeder
{
    public function run(): void
    {
        $tipos_equipamentos = [
            ['id' => 1, 'nome' => 'DESKTOP - 1 CABO A/C'],
            ['id' => 2, 'nome' => 'MONITOR - 1 CABO A/C - 1 CABO VGA'],
            ['id' => 3, 'nome' => 'ESTABILIZADOR'],
            ['id' => 4, 'nome' => 'MOUSE'],
            ['id' => 5, 'nome' => 'TECLADO'],
            ['id' => 6, 'nome' => 'IMPRESSORA - 1 CABO A/C'],
            ['id' => 7, 'nome' => 'NOTEBOOK - 1 FONTE'],
            ['id' => 8, 'nome' => 'TABLET - 1 CARREGADOR'],
            ['id' => 9, 'nome' => 'MONITOR - 1 FONTE - 1 CABO VGA'],
            ['id' => 10, 'nome' => 'MONITOR - 1 FONTE - 1 CABO HDMI'],
            ['id' => 11, 'nome' => 'MONITOR - 1 CABO A/C - 1 CABO HDMI'],
        ];

        // Limpa a tabela antes de inserir
        DB::table('tipos_equipamentos')->truncate();

        // Insere os dados
        DB::table('tipos_equipamentos')->insert($tipos_equipamentos);
    }
}