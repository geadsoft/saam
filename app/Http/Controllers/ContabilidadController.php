<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContabilidadController extends Controller
{
    public function ccosto_ctas()
    {
        return view('contabilidad/ccosto_ctas');
    }

    public function auxiliar($periodo,$cuenta,$ccosto)
    {
        $periodo = $periodo;
        $cuenta = $cuenta;
        $ccosto = $ccosto;

        return view('contabilidad.auxiliar_cuentas', compact('periodo', 'ccosto', 'cuenta'));
    }

    public function plan_cuentas()
    {
        return view('contabilidad/plan_cuentas');
    }
}
