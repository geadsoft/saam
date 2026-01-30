<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\TdPeriodoVacaciones;
use App\Models\TdSolicitudVacaciones;

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

        $periods = TdPeriodoVacaciones::where('employee_id', $request->employee_id)
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
                'vacation_request_id' => $request->id,
                'vacation_period_id' => $period->id,
                'dias' => $use
            ]);

            $remaining -= $use;
        }
    }
}