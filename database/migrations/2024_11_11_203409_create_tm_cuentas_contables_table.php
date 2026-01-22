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
        Schema::create('tm_cuentas_contables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tiporol_id')->unsigned();
            $table->string('remuneracion',1);
            $table->unsignedBigInteger('rubro_id')->unsigned()->nullable();
            $table->string('rubro_pago',2)->nullable();
            $table->string('cuenta',22);
            $table->string('descripcion',150);
            $table->string('tipo',2);
            $table->string('comprobante',1);
            $table->integer('ccosto');
            $table->boolean('gastodeducible');
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('tiporol_id')->references('id')->on('tm_tiposrols');
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
        Schema::dropIfExists('tm_cuentas_contables');
    }
};
