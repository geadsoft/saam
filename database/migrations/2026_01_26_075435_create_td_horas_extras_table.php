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
        Schema::create('td_horas_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periodorol_id')->unsigned();
            $table->unsignedBigInteger('persona_id')->unsigned()->nullable();
            $table->datetime('fecha')->nullable();
            $table->decimal('horas',5,2);
            $table->decimal('extra25',5,2);
            $table->double('monto25',14,2);
            $table->decimal('extra50',5,2);
            $table->double('monto50',14,2);
            $table->decimal('extra100',5,2);
            $table->double('monto100',14,2);
            $table->double('total',14,2);
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('tm_personas');
            $table->foreign('periodorol_id')->references('id')->on('tm_periodosrols');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_horas_extras');
    }
};
