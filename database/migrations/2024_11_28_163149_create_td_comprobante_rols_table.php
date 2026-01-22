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
        Schema::create('td_comprobante_rols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comprobante_id')->unsigned();
            $table->integer('tipo');
            $table->integer('mes');
            $table->integer('periodo');
            $table->datetime('fecha');
            $table->string('cuenta',22);
            $table->string('detalle',150);
            $table->string('naturaleza',1);
            $table->double('valor',14,2);
            $table->string('estado',1);
            $table->boolean('deducible');
            $table->integer('ccosto');
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('comprobante_id')->references('id')->on('tc_comprobante_rols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_comprobante_rols');
    }
};
