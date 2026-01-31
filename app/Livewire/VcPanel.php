<?php

namespace App\Livewire;
use App\Models\TmPersonas;
use App\Models\TcRolPagos;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class VcPanel extends Component
{

    public $hombres, $mujeres, $total, $monto;
    public $chartsrol, $charts2, $charts3, $glosa, $mes, $periodo;
    public $objmes = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10=> 'OCTUBRE',
        11=> 'NOVIEMBRE',
        12=> 'DICIEMBRE',
    ];

    public function mount(){

        $response = Http::get('http://181.198.111.178/api-erp/api/infoCia');
        $cia = $response->object();
        
        $rolpago  = TcRolPagos::query()
        ->where('remuneracion','M')
        ->orderByRaw('periodo, mes desc')
        ->first();

        if(empty($rolpago)){
            $this->periodo = $cia->ejercicio;
            $this->mes = 1;
        }else{
            $this->periodo = $rolpago['periodo'];
            $this->mes = $rolpago['mes'];
        }

        $this->consulta();
    }

    public function render()
    {
        
        return view('livewire.vc-panel',[
            'periodo' => $this->periodo,
            'mes' => $this->mes,
        ]);

    }

    public function updatedMes($mes)
    {
        $this->mes = intval($mes);
        $this->chartsrol = [];
        $this->charts2=[];
        $this->charts3=[];        
        $this->consulta();
        
    }

    public function consulta()
    {

        $personas = TmPersonas::query()
        ->where("estado","A")
        ->get();
        
        $this->hombres = $personas->where('sexo','M')->count('id');
        $this->mujeres = $personas->where('sexo','F')->count('id');
        $this->total = $this->hombres+$this->mujeres;

        $tcrol = TcRolPagos::query()
        ->join('tm_tiposrols as t','t.id','=','tc_rol_pagos.tiposrol_id')
        ->join('tm_catalogogenerals as g','g.id','=','t.tipoempleado_id')
        ->select('tc_rol_pagos.*','g.descripcion')
        ->where('remuneracion','M')
        ->where('periodo',$this->periodo)
        ->where('mes',$this->mes)
        ->orderBy('total')
        ->get();

        $this->monto = $tcrol->sum('total');

        $array=[];
        foreach($tcrol as $rol){

            $array[] = [
                'name' =>  $rol->descripcion,
                'y' => floatVal($rol->total)
            ];
           
        }
        $this->chartsrol= json_encode($array);
        $this->dispatch('graph-1', newObj: $this->chartsrol);

        /* Ingresos - Egresos */
        $array=[];
        $array[] = [
            'name' =>  'Ingresos',
            'y' => floatVal($tcrol->sum('ingresos'))
        ];
        $array[] = [
            'name' =>  'Egresos',
            'y' => floatVal($tcrol->sum('egresos'))
        ];
        $this->charts3 = json_encode($array);
        $this->dispatch('graph-3', newObj: $this->charts3);

        /* Monto Nomina */
        $array=[];
        foreach($tcrol as $rol){

            $array[] = [
                'name' =>  $rol->descripcion,
                'y' => floatVal($rol->total)
            ];
        }
        $this->charts1 = json_encode($array);
        $this->dispatch('graph-2', newObj: $this->charts1);
        
        
        
    }

    
}
