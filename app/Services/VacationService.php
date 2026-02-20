<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\TdPeriodoVacaciones;
use App\Models\TdSolicitudVacaciones;
use App\Models\TdMovimientosVacaciones;

class VacationService
{
    public static function getAvailableDays($employeeId)
    {
        return TdPeriodoVacaciones::where('persona_id', $employeeId)
            ->sum(DB::raw('dias_generados - dias_usados'));
    }

    public static function consumeDaysFIFO(TdSolicitudVacaciones $request)
    {
        $remaining = $request->dias;

        $periods = TdPeriodoVacaciones::where('persona_id', $request->persona_id)
            ->orderBy('periodo')
            ->lockForUpdate()
            ->get();

        foreach ($periods as $period) {
            if ($remaining <= 0) break;

            $available = $period->dias_generados - $period->dias_usados;

            if ($available <= 0) continue;

            $use = min($available, $remaining);

            $period->dias_usados += $use;
            $period->save();

            TdMovimientosVacaciones::create([
                'solicitud_vacacion_id' => $request->id,
                'periodo_vacacion_id' => $period->id,
                'dias_descontados' => $use,
                'fecha' => now()
            ]);

            $remaining -= $use;
        }
    }
}