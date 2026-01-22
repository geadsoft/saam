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
        Schema::create('lectura_com', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id');
            $table->integer('sucursal');
            $table->string('proceso',3);
            $table->double('valor',14,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectura_com');
    }
};
