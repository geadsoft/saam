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
        Schema::create('tm_horarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',80);
            $table->time('entrada');
            $table->time('salida');
            $table->time('ini_entrada');
            $table->time('fin_entrada');
            $table->time('ini_salida');
            $table->time('fin_salida');
            $table->boolean('nocturno');
            $table->integer('jornada');
            $table->integer('tolerancia');
            $table->integer('descanso');
            $table->time('ini_descanso');
            $table->time('fin_descanso');
            $table->string('estado',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_horarios');
    }
};
