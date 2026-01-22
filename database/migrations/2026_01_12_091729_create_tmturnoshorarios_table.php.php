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
        Schema::create('tm_turnos_horarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',80);
            $table->biginteger('area_id')->unsigned();
            $table->biginteger('horario_id')->unsigned();

            /// Horas suplementarias 25%
            $table->boolean('sup_25_aplica')->default(false);
            $table->decimal('sup_25_porcentaje', 5, 2)->default(0);

            // Horas suplementarias 50%
            $table->boolean('sup_50_aplica')->default(false);
            $table->decimal('sup_50_porcentaje', 5, 2)->default(0);

            // Horas extraordinarias
            $table->boolean('extra_aplica')->default(false);
            $table->decimal('extra_porcentaje', 5, 2)->default(0);

            // Días con recargo 100%
            $table->json('dias_extra')->nullable();

            // A = Activo | I = Inactivo
            $table->char('estado', 1)->default('A');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('tm_areas');
            $table->foreign('horario_id')->references('id')->on('tm_horarios');
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_turnos_horarios');
    }
};
