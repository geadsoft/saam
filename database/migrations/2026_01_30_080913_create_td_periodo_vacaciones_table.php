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
        Schema::create('td_periodo_vacaciones', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->bigInteger('periodo')->default(0);
            $table->bigInteger('dias_generados')->default(0);
            $table->bigInteger('dias_usados')->default(0);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('tm_personas');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_periodo_vacaciones');
    }
};
