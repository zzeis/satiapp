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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('acao'); // Ex: "Cadastro de Equipamento"
            $table->text('detalhes')->nullable(); // Detalhes da ação
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade'); // Quem fez a ação
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
