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
        Schema::create('tc_comprobante_rols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rolpago_id')->unsigned();
            $table->string('comprobante',1);
            $table->integer('mes');
            $table->integer('periodo');
            $table->string('tipo',2);
            $table->string('documento',7);
            $table->datetime('fecha');
            $table->string('codigo',6);
            $table->string('observacion',150);
            $table->double('debito',14,2);
            $table->double('credito',14,2);
            $table->double('total',14,2);
            $table->string('estado',1);
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('rolpago_id')->references('id')->on('tc_rol_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tc_comprobante_rols');
    }
};
