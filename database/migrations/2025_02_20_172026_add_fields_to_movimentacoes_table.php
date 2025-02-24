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
            $table->uuid('manutencao_id')->after('id');
            $table->string('acao')->after('manutencao_id');
            $table->text('descricao')->nullable()->after('acao');
            $table->uuid('user_id')->after('descricao');

            // Chaves estrangeiras
            $table->foreignUuid('manutencao_id')->references('id')->on('manutencoes')->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            $table->dropForeign(['manutencao_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['manutencao_id', 'acao', 'descricao', 'user_id']);
        });
    }
};
