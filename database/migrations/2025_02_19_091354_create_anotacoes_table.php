<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anotacoes', function (Blueprint $table) {
            $table->id();

            // Chaves estrangeiras UUID
            $table->uuid('id_equipamento')->nullable();
            $table->uuid('id_manutencao')->nullable();
            $table->uuid('id_termoEntrega')->nullable();

            $table->text('anotacao');
            $table->uuid('user_id');
            $table->timestamps();

            $table->softDeletes();

            // Constraints de chave estrangeira

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_equipamento')
                ->references('id')
                ->on('equipamentos')
                ->onDelete('cascade');

            $table->foreign('id_manutencao')
                ->references('id')
                ->on('manutencaos')
                ->onDelete('cascade');

            $table->foreign('id_termoEntrega')
                ->references('id')
                ->on('termo_entregas')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anotacoes');
    }
};
