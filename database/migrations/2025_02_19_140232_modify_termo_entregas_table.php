<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona os campos "data_devolucao" e "user_devolucao_id" à tabela "termo_entregas".
     */
    public function up()
    {
        Schema::table('termo_entregas', function (Blueprint $table) {
            // Adiciona o campo "data_devolucao" como nullable
            $table->date('data_devolucao')->nullable()->after('data_entrega');

            // Adiciona o campo "user_devolucao_id" como UUID nullable
            $table->foreignUuid('user_devolucao_id')->nullable()->after('data_devolucao');

            // Adiciona chave estrangeira para a tabela "users"
            $table->foreign('user_devolucao_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverte as alterações:
     * - Remove os campos "data_devolucao" e "user_devolucao_id".
     */
    public function down()
    {
        Schema::table('termo_entregas', function (Blueprint $table) {
            // Remove a chave estrangeira e o campo "user_devolucao_id"
            $table->dropForeign(['user_devolucao_id']);
            $table->dropColumn('user_devolucao_id');

            // Remove o campo "data_devolucao"
            $table->dropColumn('data_devolucao');
        });
    }
};
