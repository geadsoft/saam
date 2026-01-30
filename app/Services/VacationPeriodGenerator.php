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
        $anioIngreso  = $fechaIngreso->year;
        $anioActual   = now()->year;

        DB::transaction(function () use ($personaId, $anioIngreso, $anioActual) {

            for ($anio = $anioIngreso; $anio <= $anioActual; $anio++) {

                $existe = TdPeriodoVacaciones::where('persona_id', $personaId)
                    ->where('periodo', $anio)
                    ->exists();

                if ($existe) {
                    continue;
                }

                $aniosCumplidos = ($anio - $anioIngreso) + 1;

                $dias = 15;
                if ($aniosCumplidos >= 6) {
                    $dias += ($aniosCumplidos - 5);
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