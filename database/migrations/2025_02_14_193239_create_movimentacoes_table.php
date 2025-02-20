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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('equipamento_id')->constrained('equipamentos')->onDelete('cascade');
            $table->enum('tipo', ['entrada', 'saida', 'manutencao', 'troca']);
            $table->date('data');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};
