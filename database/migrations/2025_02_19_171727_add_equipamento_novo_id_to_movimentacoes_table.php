<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Adiciona o campo equipamento_novo_id como UUID
            $table->uuid('equipamento_novo_id')->nullable();

            // Define a chave estrangeira
            $table->foreign('equipamento_novo_id')
                ->references('id')
                ->on('equipamentos')
                ->onDelete('set null'); // Define o comportamento ao deletar o equipamento
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Remove a chave estrangeira
            $table->dropForeign(['equipamento_novo_id']);

            // Remove o campo equipamento_novo_id
            $table->dropColumn('equipamento_novo_id');
        });
    }
};
