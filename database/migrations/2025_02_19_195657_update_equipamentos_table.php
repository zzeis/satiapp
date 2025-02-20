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
            Schema::table('equipamentos', function (Blueprint $table) {
                // Verifica se a coluna 'tipo' existe antes de tentar removê-la
                if (Schema::hasColumn('equipamentos', 'tipo')) {
                    $table->dropColumn('tipo');
                }
    
                // Adicionar a foreign key para a tabela 'tipos' (bigint unsigned)
                $table->unsignedBigInteger('tipo_id')->after('id');
    
                // Criar a chave estrangeira corretamente
                $table->foreign('tipo_id')->references('id')->on('tipos_equipamentos')->onDelete('cascade');
            });
        }
    
    

        public function down()
        {
            Schema::table('equipamentos', function (Blueprint $table) {
                // Remover a foreign key e a coluna 'tipo_id'
                if (Schema::hasColumn('equipamentos', 'tipo_id')) {
                    $table->dropForeign(['tipo_id']);
                    $table->dropColumn('tipo_id');
                }
    
                // Recriar a coluna 'tipo' apenas se não existir
                if (!Schema::hasColumn('equipamentos', 'tipo')) {
                    $table->string('tipo')->after('id');
                }
            });
        }
};
