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
        Schema::create('td_novedades', function (Blueprint $table) {
            $table->id();
            $table->biginteger('novedad_id')->unsigned();
            $table->datetime('fecha');
            $table->string('enviado',100);
            $table->string('observacion',300);
            $table->string('usuario',80);
            $table->timestamps();
            
            $table->foreign('novedad_id')->references('id')->on('tc_novedades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_novedades');
    }
};
