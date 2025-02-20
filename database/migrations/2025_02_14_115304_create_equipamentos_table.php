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
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('secretaria_id')->constrained();
            $table->foreignUuid('responsavel_id')->nullable()->constrained('pessoas');
            $table->enum('status', ['manutencao', 'em_uso', 'estoque', 'descartado'])->default('estoque');
            $table->string('tipo');
            $table->string('numero_serie')->unique();
            $table->string('modelo');
            $table->text('especificacoes')->nullable();
            $table->date('data_chegada')->nullable();
            $table->date('data_ultima_manutencao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
