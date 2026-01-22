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
        Schema::table('tc_rol_pagos', function (Blueprint $table) {
            $table->unsignedBigInteger('diarioProvision_id')->after('total')->unsigned()->nullable();
            $table->unsignedBigInteger('diarioNomina_id')->after('total')->unsigned()->nullable();

            $table->foreign('diarioProvision_id')->references('id')->on('tc_comprobante_rols');
            $table->foreign('diarioNomina_id')->references('id')->on('tc_comprobante_rols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tc_rol_pagos', function (Blueprint $table) {
            $table->dropColumn('diarioProvision_id');
            $table->dropColumn('diarioNomina_id');
        });
    }
};
