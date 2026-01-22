<?php

namespace App\Livewire;
use App\Models\TcRolPagos;
use App\Models\TmPeriodosrol;
use App\Models\TcComprobanteRol;
use App\Models\TmCuentasContables;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class VcNominas extends Component
{   
    use WithPagination;

    public $detalle = [];
    public $rolpagoId;

    public $filters = [
        'mes' => '',
        'periodo' => '',
        'tiporol' => '',
        'departamento'=>'',
        'proceso' => '',
    ];

    public $meses = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    ];

    public function render()
    {
        $tblrecords  = TcRolPagos::query()
        ->leftjoin('tc_comprobante_rols as p','p.id','=','tc_rol_pagos.diarioProvision_id')
        ->leftjoin('tc_comprobante_rols as n','n.id','=','tc_rol_pagos.diarioNomina_id')
        ->when($this->filters['mes'],function($query){
            return $query->where('mes',$this->filters['mes']);
        })
        ->when($this->filters['periodo'],function($query){
            return $query->where('periodo',$this->filters['periodo']);
        })
        ->when($this->filters['tiporol'],function($query){
            return $query->where('tiposrol_id',$this->filters['tiporol']);
        })
        ->when($this->filters['proceso'],function($query){
            return $query->where('remuneracion',$this->filters['proceso']);
        })
        ->select('tc_rol_pagos.*','p.documento as provision','n.documento as nomina')
        ->orderByRaw('periodo desc, mes desc,tiposrol_id')
        ->paginate(10);

        return view('livewire.vc-nominas',[
            'tblrecords' => $tblrecords,
            'meses' => $this->meses,
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function loadDetalle(){

    }

    public function edit($rolpagoId){

        return redirect()->to('/payroll/registrar-pagos/edit/'.$rolpagoId);

    }

    public function generaDiario($rolpagoId){

        $this->rolpagoId = $rolpagoId;
        $rolpago = TcRolPagos::find($rolpagoId);

        $cuentas = TmCuentasContables::query()
        ->where('tiporol_id',$rolpago['tiposrol_id'])
        ->where('remuneracion',$rolpago['remuneracion'])
        ->get();

        if (count($cuentas)==0){
            $this->dispatch('msg-cuenta');
        }else{
            $this->dispatch('show-diario');
        }
        
    }

    public function comprobante(){
        
        $sqlDiario = DB::select("call genera_diarios_rol(".$this->rolpagoId.")");

        $diario = TcComprobanteRol::query()
        ->where('rolpago_id',$this->rolpagoId)
        ->where('comprobante','P')
        ->first();

        $rolpago = TcRolPagos::find($this->rolpagoId);
        $rolpago->update([
            'diarioProvision_id' => $diario->id,
        ]);

        $diario = TcComprobanteRol::query()
        ->where('rolpago_id',$this->rolpagoId)
        ->where('comprobante','N')
        ->first();

        $rolpago->update([
            'diarioNomina_id' => $diario->id,
        ]);
        
        $this->dispatch('hide-diario');

    }

    public function printData($tipo, $rolpagoId){

        $tcrolPago = TcRolPagos::find($rolpagoId);
        $filters['rolpagoId'] = $rolpagoId;
        $filters['periodoRol'] = $tcrolPago['periodosrol_id'];
        $filters['tipoRol'] = $tcrolPago['tiposrol_id'];

        $datos = json_encode($filters);

        if($tipo=="PAGO"){
            $this->dispatch('pago-pdf',data:$datos);
        }

        if($tipo=="NOM"){
            $this->dispatch('nomina-pdf',data:$datos);
        }

        if($tipo=="ROL"){
            $this->dispatch('rol-pdf',data:$datos);
        }
       
    }


}
