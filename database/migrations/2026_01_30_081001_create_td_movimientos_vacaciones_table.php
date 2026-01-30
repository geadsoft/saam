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
        Schema::create('td_movimientos_vacaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_vacacion_id')->unsigned();
            $table->unsignedBigInteger('periodo_vacacion_id')->unsigned();
            $table->bigInteger('dias_descontados')->default(0);
            $table->datetime('fecha')->nullable();
            $table->timestamps();

            $table->foreign('solicitud_vacacion_id')->references('id')->on('td_solicitud_vacaciones');
            $table->foreign('periodo_vacacion_id')->references('id')->on('td_periodo_vacaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_movimientos_vacaciones');
    }
};
