<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiometricoController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'dispositivo_id' => 'required',
            'logs' => 'required|array'
        ]);

        dd($request->logs);
        
        foreach ($request->logs as $log) {

            $hash = hash('sha256',
                $log['empleado_id'] .
                $log['fecha_hora'] .
                $request->dispositivo_id
            );

            AsistenciaMarcacion::firstOrCreate(
                ['hash_unico' => $hash],
                [
                    'empleado_id' => $log['empleado_id'],
                    'dispositivo_id' => $request->dispositivo_id,
                    'fecha' => date('Y-m-d', strtotime($log['fecha_hora'])),
                    'hora' => date('H:i:s', strtotime($log['fecha_hora'])),
                    'fecha_hora' => $log['fecha_hora'],
                    'zk_uid' => $log['zk_uid'],
                ]
            );
        }

        return response()->json(['status' => 'ok']);
    }
}
