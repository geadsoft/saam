<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\TdPeriodoVacaciones;
use App\Models\TmContratos;

class VacationPeriodGenerator
{
    public static function generateForPersona($personaId)
    {
        $contratoBase = TmContratos::where('persona_id', $personaId)
            ->orderBy('fecha_ingreso', 'asc')
            ->first();

        if (!$contratoBase) {
            return;
        }

        $fechaIngreso = Carbon::parse($contratoBase->fecha_ingreso);
        $anioInicioVacaciones = $fechaIngreso->copy()->addYear()->year;
        $anioActual = now()->year;

        DB::transaction(function () use ($personaId, $anioInicioVacaciones, $anioActual, $fechaIngreso) {

            for ($anio = $anioInicioVacaciones; $anio <= $anioActual; $anio++) {

                $existe = TdPeriodoVacaciones::where('persona_id', $personaId)
                    ->where('periodo', $anio)
                    ->exists();

                if ($existe) {
                    continue;
                }

                $aniosCumplidos = $fechaIngreso->diffInYears(Carbon::create($anio));

                $dias = 15;

                if ($aniosCumplidos >= 5) {
                    $dias += ($aniosCumplidos - 4);
                }

                TdPeriodoVacaciones::create([
                    'persona_id'     => $personaId,
                    'periodo'        => $anio,
                    'dias_generados' => $dias,
                    'dias_usados'    => 0,
                ]);
            }
        });
    }
}