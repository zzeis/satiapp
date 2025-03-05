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
        Schema::create('termo_equipamentos', function (Blueprint $table) {
            // Coluna ID (chave primária)
            $table->id();

            // Chave estrangeira para a tabela 'termos' (UUID)
            $table->uuid('termo_id');
            $table->foreign('termo_id')
                  ->references('id')
                  ->on('termo_entregas')
                  ->onDelete('cascade');

            // Chave estrangeira para a tabela 'equipamentos' (UUID)
            $table->uuid('equipamento_id');
            $table->foreign('equipamento_id')
                  ->references('id')
                  ->on('equipamentos')
                  ->onDelete('cascade');

            // Quantidade do equipamento no termo
            $table->integer('quantidade')->default(1);

            // Timestamps (created_at e updated_at)
            $table->timestamps();

            // Soft Deletes (deleted_at)
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('termo_equipamentos');
    }
};
