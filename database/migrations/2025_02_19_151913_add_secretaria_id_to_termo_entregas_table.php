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
            // Adiciona a coluna secretaria_id
            $table->foreignUuid('secretaria_id')->nullable()->constrained('secretarias')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('termo_entregas', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna
            $table->dropForeign(['secretaria_id']);
            $table->dropColumn('secretaria_id');
        });
    }
};
