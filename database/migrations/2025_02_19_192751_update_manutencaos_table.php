<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('manutencaos', function (Blueprint $table) {
            // Remover os campos antigos
            $table->dropColumn('empresa_terceirizada');
            $table->dropColumn('contato_email');
            $table->dropColumn('contato_telefone');
            
            // Adicionar os novos campos
            $table->string('local'); // Novo campo
            $table->foreignUuid('secretaria_id')->constrained(); // Novo campo com chave estrangeira
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manutencaos', function (Blueprint $table) {
            // Reverter as mudanças
            $table->string('empresa_terceirizada');
            $table->string('contato_email');
            $table->string('contato_telefone')->nullable();
            
            // Remover os novos campos
            $table->dropColumn('local');
            $table->dropForeign(['secretaria_id']);
            $table->dropColumn('secretaria_id');
        });
    }
};
