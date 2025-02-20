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
        Schema::table('users', function (Blueprint $table) {
            // Remove a coluna id atual
            $table->dropColumn('id');
        });
    
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna id como UUID
            $table->uuid('id')->primary()->first();
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverte para BIGINT UNSIGNED
            $table->dropColumn('id');
        });
    
        Schema::table('users', function (Blueprint $table) {
            $table->id()->first();
        });
    }
};
