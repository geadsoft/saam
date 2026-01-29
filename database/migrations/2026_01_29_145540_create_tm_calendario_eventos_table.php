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
        Schema::create('tm_calendario_eventos', function (Blueprint $table) {
            $table->id();
            $table->integer('periodo');
            $table->integer('mes');
            $table->string('actividad',2);
            $table->string('nombre',50);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('descripcion',255);
            $table->string('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_calendario_eventos');
    }
};
