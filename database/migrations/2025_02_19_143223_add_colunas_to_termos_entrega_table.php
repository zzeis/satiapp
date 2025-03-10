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
        Schema::table('termo_entregas', function (Blueprint $table) {
            $table->boolean('processado')->default(false)->after('arquivo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('termos_entrega', function (Blueprint $table) {
            $table->dropColumn('processado');
        });
    }
};