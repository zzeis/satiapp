<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('manutencaos', function (Blueprint $table) {
            $table->uuid('equipamento_novo_id')->nullable();
            $table->json('dados_equipamento_antigo')->nullable();

            $table->foreign('equipamento_novo_id')
                ->references('id')
                ->on('equipamentos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manutencaos', function (Blueprint $table) {
            $table->dropForeign(['equipamento_novo_id']);
            $table->dropColumn(['equipamento_novo_id', 'dados_equipamento_antigo']);
        });
    }
};
