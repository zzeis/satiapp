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
        Schema::create('termo_entregas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('equipamento_id')->constrained('equipamentos')->onDelete('cascade');
            $table->foreignId('secretaria_id')->constrained('secretarias')->onDelete('cascade');
            $table->foreignId('pessoa_id')->constrained('pessoas')->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained(); // Funcionário do TI que registrou
            $table->string('arquivo_path')->nullable();
            $table->date('data_entrega');
            $table->enum('status', ['entregue', 'pendente', 'cancelada'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termo_entregas');
    }
};
