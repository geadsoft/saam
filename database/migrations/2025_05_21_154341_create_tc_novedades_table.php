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
        Schema::create('tc_novedades', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->string('titulo',150);
            $table->string('descripcion',300);
            $table->string('usuario',80);
            $table->string('asignado',100);
            $table->datetime('fechaini') -> nullable();
            $table->datetime('fechafin') -> nullable();
            $table->string('estado',1);
            $table->string('prioridad',1);
            $table->string('tipo',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_novedades');
    }
};
