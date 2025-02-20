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
        Schema::create('manutencaos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('equipamento_id')->constrained();
            $table->foreignUuid('user_id')->constrained(); 
            $table->string('empresa_terceirizada'); //remover
            $table->string('contato_email'); //remover 
            $table->string('contato_telefone')->nullable(); //remover 
            $table->text('descricao_problema');
            $table->enum('status', ['aberto', 'em_andamento', 'concluido', 'cancelado'])->default('aberto');
            $table->date('data_abertura');
            $table->date('data_visita')->nullable();
            $table->date('data_conclusao')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencaos');
    }
};
