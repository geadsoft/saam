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
        Schema::table('lectura_com', function (Blueprint $table) {
            // Crea índice único para evitar duplicados del mismo usuario, sucursal y proceso
            $table->unique(['usuario_id', 'sucursal', 'proceso'], 'lectura_unique_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lectura_com', function (Blueprint $table) {
            // Elimina el índice único en caso de rollback
            $table->dropUnique('lectura_unique_idx');
        });
    }
};
