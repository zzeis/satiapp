<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Modifica a tabela "movimentacoes":
     * - Torna o campo "manutencao_id" nullable e do tipo UUID.
     * - Adiciona o campo "termo_id" como UUID nullable.
     */
    public function up()
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Altera o campo "manutencao_id" para UUID e nullable
            $table->foreignUuid('manutencao_id')->nullable()->change();

            // Adiciona o campo "termo_id" como UUID nullable
            $table->foreignUuid('termo_id')->nullable()->after('manutencao_id');


            // Adiciona chave estrangeira para a tabela "termo_entregas"
            $table->foreign('termo_id')->references('id')->on('termo_entregas')->onDelete('cascade');
        });
    }

    /**
     * Reverte as alterações:
     * - Remove o campo "termo_id".
     * - Altera o campo "manutencao_id" de volta para o tipo original (se necessário).
     */
    public function down()
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Remove as chaves estrangeiras
            $table->dropForeign(['manutencao_id']);
            $table->dropForeign(['termo_id']);

            // Remove o campo "termo_id"
            $table->dropColumn('termo_id');

            // Altera o campo "manutencao_id" de volta para o tipo original (se necessário)
            $table->uuid('manutencao_id')->nullable(false)->change();
        });
    }
};
