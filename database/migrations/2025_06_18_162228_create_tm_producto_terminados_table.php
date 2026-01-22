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
        Schema::create('tm_producto_terminados', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->string('tanque',8);
            $table->string('producto',4);
            $table->double('tonelada',14,2);
            $table->string('ubicacion');
            $table->double('acidez',14,2);
            $table->double('humedad',14,2);
            $table->double('impureza',14,2);
            $table->string('color',15);
            $table->double('peroxido',14,2);
            $table->string('referencia',30);
            $table->string('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_producto_terminados');
    }
};
