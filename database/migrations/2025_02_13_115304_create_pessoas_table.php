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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('secretaria_id')->constrained();
            $table->string('nome');
            $table->string('cpf', 11)->unique();
            $table->string('cargo');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('cpf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
