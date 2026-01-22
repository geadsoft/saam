<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class VcPanelNegocio extends Component
{
    public $charts, $periodo, $mes, $totalFruta, $totalCosto, $totalPrecio, $fechaini, $fechafin;

    public function mount(){
       
        $response = Http::get('http://181.198.111.178/api-erp/api/infoCia');
        $cia = $response->object();

        $this->periodo = $cia->ejercicio;
        $this->mes = $cia->mesinventarios;

        $this->fechaini = Carbon::now()->startOfMonth()->toDateString();
        $this->fechafin = Carbon::now()->endOfMonth()->toDateString();
    }
    
    public function render()
    {

        $response = Http::get('http://181.198.111.178/api-erp/api/proyecta-costo', [
            'periodo' => $this->periodo,
            'mes' => $this->mes
        ]);
        $costos= collect($response->object())
        ->values();
   
        $response = Http::get('http://181.198.111.178/api-erp/api/datos-produccion', [
            'fechaIni' => $this->fechaini,
            'fechaFin' => $this->fechafin
        ]);
        $produccion= $response->object();


        $response = Http::get('http://181.198.111.178/api-erp/api/datos-fruta', [
            'fechaIni' => $this->fechaini,
            'fechaFin' => $this->fechafin
        ]);
        $tblrecords = collect($response->object())
        ->values();

        $this->totalFruta = $tblrecords->sum('toneladas');
        $this->totalCosto = $tblrecords->sum('liquidar');
        $this->totalprecio = round($this->totalCosto/$this->totalFruta,2);


        $response = Http::get('http://181.198.111.178/api-erp/api/vtas-facturada', [
            'fechaIni' => $this->fechaini,
            'fechaFin' => $this->fechafin
        ]);
        $facturado = collect($response->object())
        ->values();


        $response = Http::get('http://181.198.111.178/api-erp/api/vtas-porfacturar', [
            'fechaIni' => $this->fechaini,
            'fechaFin' => $this->fechafin
        ]);
        $porfacturar = collect($response->object())
        ->values();


        $response = Http::get('http://181.198.111.178/api-erp/api/consumo-refineria', [
            'fechaIni' => $this->fechaini,
            'fechaFin' => $this->fechafin
        ]);
        $refineria = $response->object();

        $grahp[]='';
        foreach($tblrecords as $record){

            $grahp[] = [
                'name' => $record->EntregaFruta,
                'y' => floatVal($record->toneladas)
            ];

        }

        $this->charts = json_encode($grahp);
        $this->charts = str_replace('"name"','name',$this->charts);
        $this->charts = str_replace('"y"','y',$this->charts);

        return view('livewire.vc-panel-negocio',[
            'tblrecords' => $tblrecords,
            'facturado' => $facturado,
            'facturar' => $porfacturar,
            'produccion' => $produccion,
            'refineria' => $refineria,
            'costos' => $costos,
        ]);
    }
}
