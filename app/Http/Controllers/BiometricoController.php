<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiometricoController extends Controller
{
    public function receivePush(Request $request)
    {
        foreach ($request->logs as $log) {
            DB::table('td_timbres')->updateOrInsert(
                [
                    'codigo' => $log['sn'],
                    'fecha_hora' => $log['datetime'],
                    'fecha' => date('Y-m-d', strtotime($log['datetime'])),
                    'hora' => date('H:i:s', strtotime($log['datetime'])),
                ],
                [
                    'funcion' => $log['type'],
                    'estado' => 'A',
                    'created_at' => now(),
                ]
            );
        }

        return response()->json(['ok' => true]);
    }
}
