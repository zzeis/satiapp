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
        Schema::table('termo_entregas', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('observacoes');
        });
    }

    /**
     * Remove o campo "status" da tabela "termo_entregas".
     */
    public function down()
    {
        Schema::table('termo_entregas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
