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
        Schema::create('td_solicitud_vacaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->datetime('fecha')->nullable();
            $table->datetime('fecha_empieza')->nullable();
            $table->datetime('fecha_termina')->nullable();
            $table->bigInteger('dias')->default(0);
            $table->string('observacion',300);
            $table->char('estado', 1)->default('S');
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('tm_personas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_solicitud_vacaciones');
    }
};
