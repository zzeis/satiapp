<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecretariasTableSeeder extends Seeder
{
    public function run(): void
    {
        $secretarias = [
            ['id' => 1, 'nome' => 'GESTÃO DE DEPTO. EDUCAÇÃO', 'sigla' => 'GDDE'],
            ['id' => 10, 'nome' => 'SECRETARIA ADJUNTA DE TRANSITO', 'sigla' => 'SAT'],
            ['id' => 11, 'nome' => 'SECRETARIA ADJUNTA DE CULTURA E TURISMO', 'sigla' => 'SACT'],
            ['id' => 12, 'nome' => 'SECRETARIA ADJUNTA DE DESPESA DE PESSOAL', 'sigla' => 'SADP'],
            ['id' => 13, 'nome' => 'PROCURADORIA JURIDICA', 'sigla' => 'PJ'],
            ['id' => 2, 'nome' => 'GESTÃO DE DPTO. CULTURA ESPORTES E EVENTOS', 'sigla' => 'GDPCEE'],
            ['id' => 3, 'nome' => 'GESTÃO DE DEPTO. SAUDE', 'sigla' => 'GDDS'],
            ['id' => 4, 'nome' => 'GESTÃO DE DEPTO DE DESENVOLVIMENTO SUSTENTAVEL', 'sigla' => 'GDDDS'],
            ['id' => 5, 'nome' => 'GESTÃO DE DEPTO. ADMINISTRAÇÃO', 'sigla' => 'GDDA'],
            ['id' => 6, 'nome' => 'GESTÃO DE DEPTO. JUSTIÇA E CIDADANIA', 'sigla' => 'GDDJC'],
            ['id' => 7, 'nome' => 'GESTÃO DE DPTO. ASSISTENCIA E PROMOÇÃO SOCIAL', 'sigla' => 'GDPAPS'],
            ['id' => 8, 'nome' => 'SECRETARIA ADJUNTA DE ADMINISTRAÇÃO', 'sigla' => 'SADA'],
            ['id' => 9, 'nome' => 'SECRETARIA ADJUNTO DE INOVAÇÃO E TECNOLOGIA', 'sigla' => 'SATI'],
        ];

        // Limpa a tabela antes de inserir
        DB::table('secretarias')->truncate();

        // Insere os dados
        DB::table('secretarias')->insert($secretarias);
    }
}