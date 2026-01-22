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
        Schema::table('tm_empresas', function (Blueprint $table) {
            //
            $table->double('salario_basico', 14, 2)->after('usuario')->default(0);

            $table->decimal('aporte_personal', 5, 2)->after('salario_basico')->default(0);
            $table->bigInteger('rubro_appersonal')->after('aporte_personal')->default(0);

            $table->decimal('aporte_patronal', 5, 2)->after('rubro_appersonal')->default(0);
            $table->bigInteger('rubro_appatronal')->after('aporte_patronal')->default(0);

            $table->decimal('aporte_secap', 5, 2)->after('rubro_appatronal')->default(0);
            $table->bigInteger('rubro_apsecap')->after('aporte_secap')->default(0);

            $table->decimal('aporte_iece', 5, 2)->after('rubro_apsecap')->default(0);
            $table->bigInteger('rubro_apiece')->after('aporte_iece')->default(0);

            $table->bigInteger('rubro_freserva')->after('rubro_apiece')->default(0);
            $table->bigInteger('rubro_pagofreserva')->after('rubro_freserva')->default(0);

            $table->bigInteger('decimo_tercero')->after('rubro_pagofreserva')->default(0);
            $table->bigInteger('decimo_cuarto')->after('decimo_tercero')->default(0);
            $table->bigInteger('vacaciones')->after('decimo_cuarto')->default(0);

            $table->string('elaborado',50)->after('vacaciones')->default('');
            $table->string('revisado',50)->after('elaborado')->default('');
            $table->string('visto_bueno',50)->after('revisado')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_empresas', function (Blueprint $table) {
            //
            $table->dropColumn([
                'salario_basico',
                'aporte_personal',
                'rubro_appersonal',
                'aporte_patronal',
                'rubro_appatronal',
                'aporte_secap',
                'rubro_apsecap',
                'aporte_iece',
                'rubro_apiece',
                'rubro_freserva',
                'rubro_pagofreserva',
                'decimo_tercero',
                'decimo_cuarto',
                'vacaciones',
                'elaborado',
                'revisado',
                'visto_bueno',
            ]);
            
        });
    }
};
