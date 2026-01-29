<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecursosHumanosController extends Controller
{
    public function panel()
    {
        return view('rrhh/panel');
    }

    public function areas()
    {
        return view('rrhh/areas');
    }

    public function planillas()
    {
        return view('rrhh/planilla');
    }

    public function nomina()
    {
        return view('rrhh/nominas');
    }

    public function marcaciones()
    {
        return view('rrhh/marcaciones');
    }

    public function comprobante($id,$tipo)
    {
        return view('comprobanterol',['id' => $id, 'tipo' => $tipo]);
    }

    public function prestamos()
    {
        return view('rrhh/prestamos',['id' => 0]);
    }

    public function agregar_prestamos()
    {
        return view('rrhh/prestamos',['id' => 0]);
    }

    public function editar_prestamos($id)
    {
        return view('rrhh/prestamos',['id' => $id]);
    }

    public function rolpago()
    {
        return view('rrhh/rolpago');
    }

    public function agregar_rolpago($id)
    {
        return view('rrhh/registrar_pago',['id' => $id,'edit' => 'N']);
    }

    public function editar_rolpago($id)
    {
        return view('rrhh/registrar_pago',['id' => $id,'edit' => 'S']);
    }

    public function cargos()
    {
        return view('rrhh/cargocia');
    }

    public function general()
    {
        return view('rrhh/generalidad');
    }

    public function empresa()
    {
        return view('rrhh/empresa');
    }

    public function enlace_contables()
    {
        return view('rrhh/enlace-contables');
    }

    public function calendario()
    {
        return view('rrhh/calendario');
    }

    public function contratos()
    {
        return view('rrhh/contratos');
    }

    public function departamentos()
    {
        return view('rrhh/departament');
    }

    public function periodos()
    {
        return view('rrhh/periodos');
    }
    
    public function personas()
    {
        return view('rrhh/personas');
    }

    public function agregar_personas()
    {
        return view('rrhh/personas-add',['id' => 0]);
    }

    public function editar_personas($id)
    {
        return view('rrhh/personas-add',['id' => $id]);
    }

    public function rubros()
    {
        return view('rrhh/rubros');
    }

    public function agregar_rubros()
    {
        return view('rrhh/rubros-add',['id' => 0]);
    }

    public function editar_rubros($rubroid)
    {
        return view('rrhh/rubros-add',['id' => $rubroid]);
    }

    public function tipos_rol()
    {
        return view('rrhh/tiposrol');
    }

    public function asignar_rubros()
    {
        return view('rrhh/tiposrol-rubros');
    }

    public function horarios()
    {
        return view('rrhh/horarios');
    }

    public function turnos()
    {
        return view('rrhh/turnos');
    }

    public function asignarturnos()
    {
        return view('rrhh/asignaturnos');
    }

    public function hextras()
    {
        return view('rrhh/horasextras');
    }

    public function permisos()
    {
        return view('rrhh/permisos');
    }

    public function vacaciones()
    {
        return view('rrhh/vacaciones');
    }

}   
