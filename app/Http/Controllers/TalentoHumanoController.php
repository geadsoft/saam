<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TalentoHumanoController extends Controller
{
    
    public $accion=[
        0 => 'Entrada',
        1 => 'Salida',
        2 => 'Al Almuerzo',
        3 => 'Entrada Almuerzo'
    ];

    public function loadmarcaciones(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'fecha'  => 'required|date',
        ]);

        $codigo = $request->codigo;
        $fechaInicio = $request->fecha;

        // Sumamos un día para cubrir el turno nocturno (salida al día siguiente)
        $fechaFin = date('Y-m-d', strtotime($fechaInicio . ' +1 day'));

        // Buscamos las marcaciones de ambos días
        $marcaciones = DB::table('td_timbres')
            ->where('codigo', $codigo)
            ->whereIn('fecha', [$fechaInicio, $fechaFin])
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        // Opcional: Podrías mapear los datos para que el formato coincida con tu App Flutter
        $data = $marcaciones->map(function($item) {
            return [
                'dia'    => date('d', strtotime($item->fecha)),
                'mes'    => $this->getMesAbreviado($item->fecha),
                'hora'   => date('H:i A', strtotime($item->hora)),
                'evento' => $this->accion[$item->funcion], // 'Entrada', 'Salida', etc.
            ];
        });

        return response()->json($data);
    }

    // Función auxiliar para el mes en español
    private function getMesAbreviado($fecha) {
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        return $meses[date('n', strtotime($fecha)) - 1];
    }
}
