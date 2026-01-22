<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_ingresos_proyectados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('rubro_id')->unsigned();
            $table->integer('linea');
            $table->double('valor_mes',14,2);
            $table->double('valor_dia',14,2);
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('tm_personas');
            $table->foreign('rubro_id')->references('id')->on('tm_rubrosrols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_ingresos_proyectados');
    }
};
