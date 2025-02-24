<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Altera os campos para UUID
            $table->uuid('manutencao_id')->change();
            $table->uuid('user_id')->change();

            // Adiciona as novas chaves estrangeiras
            $table->foreign('manutencao_id')
                  ->references('id')
                  ->on('manutencaos')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Remove as chaves estrangeiras
            $table->dropForeign(['manutencao_id']);
            $table->dropForeign(['user_id']);

            // Reverte os campos para o tipo original (se necessário)
            $table->unsignedBigInteger('manutencao_id')->change();
            $table->unsignedBigInteger('user_id')->change();
        });
    }

};
