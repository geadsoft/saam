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
        Schema::table('td_horas_extras', function (Blueprint $table) {
            $table->unique(['persona_id', 'fecha'], 'ux_persona_fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('td_horas_extras', function (Blueprint $table) {
            $table->dropUnique('ux_persona_fecha');
        });
    }
};
