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
        Schema::create('td_timbres', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',10);
            $table->datetime('fecha_hora')->nullable();
            $table->datetime('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('funcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_timbres');
    }
};
