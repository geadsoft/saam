<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasculaController extends Controller
{
    public $tblsedes=[];
    
    public function compras()
    {
        return view('bascula/compras');
    }

    public function compra_bruto()
    {
        return view('bascula/brutocompra');
    }

    public function compra_tara($id)
    {
        return view('bascula/taracompra',[
            'id' => $id
        ]);
    }

    public function panel()
    {
        return view('bascula/dashboards');
    }

    public function ventas()
    {
        return view('bascula/ventas');
    }

    public function tanque()
    {
        return view('bascula/tanque');
    }

    public function certificados()
    {
        return view('bascula/certificados');
    }

    public function cert_calidad($tipo,$id)
    {
        return view('bascula/certificado_calidad',[
            'tipo' => $tipo,
            'id' => $id
        ]);
    }

    public function pcc()
    {
        return view('bascula/pcc');
    }

    public function abastecimiento()
    {
        return view('bascula/abastecimiento');
    }

    public function panel_negocio()
    {
        return view('panel/negocio');
    }

    public function balance_masa()
    {
        return view('panel/balance_masico');
    }
}
