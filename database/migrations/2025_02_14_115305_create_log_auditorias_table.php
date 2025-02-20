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
        Schema::create('log_auditorias', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('model_type');
            $table->uuid('model_id');
            $table->foreignUuid('user_id')->constrained();
            $table->string('acao');
            $table->json('dados_anteriores')->nullable();
            $table->json('dados_novos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_auditorias');
    }
};
