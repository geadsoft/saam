<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DateTime;
use Carbon\Carbon;

class VcDashboardsBascula extends Component
{   
    public $fecha, $periodo, $semana, $quevedo, $oriente, $totalFruta, $promedioTotal=0, $precioQuevedo, $precioOriente;
    public $tblperiodo=[], $tblsemana=[], $acopios=[], $proveedor=[];
    public $charts1,$charts2,$charts3,$charts4,$charts5;

    public function mount()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));

        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();
        
    

        $this->periodo = $this->tblperiodo[0]->periodo;

        $response = Http::get('http://181.198.111.178/api-erp/api/semana-calendario', [
            'periodo' => $this->periodo,
        ]);
        $this->tblsemana = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        /*dd($this->tblsemana);

        $record = DB::connection('sqlsrv')->table('ERP_Ban_Calendario')
        ->where('ejercicio',2026)
        ->whereRaw('? BETWEEN fechainicio AND FechaFin', date('Ymd',strtotime($ldate)))
        ->first();*/
        $hoy = Carbon::now()->startOfDay();

        $semanaActual = collect($this->tblsemana)->first(function ($item) use ($hoy) {
            $fechaInicio = Carbon::parse($item->FechaInicio)->startOfDay();
            $fechaFin = Carbon::parse($item->FechaFin)->endOfDay();

            return $hoy->between($fechaInicio, $fechaFin);
        });
        
        $this->semana = $semanaActual->Semana;

        $this->consulta();
    }
    
    public function render()
    {
        return view('livewire.vc-dashboards-bascula',[
            'acopios' => $this->acopios
        ]);
    }  

    public function consulta()
    {   
            
        $response = Http::get('http://181.198.111.178/api-erp/api/total-fruta', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "TF"
        ]);
        $fruta= collect($response->object())
        ->values();

        $fruta = $fruta[0];
     
        $this->totalFruta = $fruta->Oriente+$fruta->Quevedo;
        $subtotal = $fruta->TotalOriente+$fruta->TotalQuevedo;
        
        if ($this->totalFruta){
            $this->promedioTotal = round($subtotal/$this->totalFruta,2);
        }
        
        $this->quevedo = round($fruta->Quevedo,2);
        $this->oriente = round($fruta->Oriente,2);
        
        if($this->quevedo>0){
            $this->precioQuevedo = round($fruta->TotalQuevedo/$this->quevedo,2);
        }

        if($this->oriente>0){
            $this->precioOriente = round($fruta->TotalOriente/$this->oriente,2);
        }

        //Acopios
        /*$this->acopios = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G1"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-acopios', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G1"
        ]);
        $this->acopios = collect($response->object())
        ->values();
        
        //Toneladas
        /*$this->proveedor = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G2"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-toneladas', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G2"
        ]);
        $this->proveedor = collect($response->object())
        ->values();

        $array[] = [];
        foreach($this->proveedor as $proveedor){
            $array[] = [
                'name' => $proveedor->nombre,
                'y' => floatVal($proveedor->Tn),
                'drilldown' => null,
            ];
        }

        $this->charts1 = json_encode($array);
        
        //precio promedio
        /*$this->proveedor = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G3"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-promedio', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G3"
        ]);
        $this->proveedor = collect($response->object())
        ->values();

        $array2[] = [];
        foreach($this->proveedor as $proveedor){
            $array2[] = [
                'name' => $proveedor->nombre,
                'y' => floatVal($proveedor->Promedio),
                'drilldown' => null,
            ];
        }

        $this->charts2 = json_encode($array2);
        
        //meses
        /*$result = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G4"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-meses', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G4"
        ]);
        $result = collect($response->object())
        ->values();
        
        $stringTm1 = '';
        $stringTm2 = '';
        foreach($result as $data){
           $stringTm1 = $stringTm1 . round($data->Tn1,2) .', ';
           $stringTm2 = $stringTm2 . round($data->Tn2,2) .', ';
        }
        $stringTm1 = rtrim($stringTm1, ', ');
        $stringTm2 = rtrim($stringTm2, ', ');

        $array3[] = [
            'name' => 'Quevedo',
            'data' => [$stringTm1],
        ];
        
        $array3[] = [
            'name' => 'Oriente',
            'data' => [$stringTm2],
        ];

        $strarray = json_encode($array3);
        $strarray = str_replace('"name"','name',$strarray);
        $strarray = str_replace('"data"','data',$strarray);
        $strarray = str_replace('["','[',$strarray);
        $strarray = str_replace('"]',']',$strarray);

        $this->charts3 = $strarray;
        
        //Fecha semana
        /*$result = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G5"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-semanas', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G5"
        ]);
        $result = collect($response->object())
        ->values();


        $array4[] = [];
        foreach($result as $data){
            $array4[] = [
                'name' => $data->dia.' '.$data->fecha,
                'y' => floatVal($data->Tn),
            ];
        }

        $this->charts4 = json_encode($array4);

        //Fecha Variedad
        /*$result = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G6"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-variedad', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G6"
        ]);
        $result = collect($response->object())
        ->values();
        
        $collection = collect($result);
        $groupedByVariedad = $collection->groupBy('fecha');

        $array5[] = [];
        foreach($groupedByVariedad as $day => $data){
            $stringTm = '';
            foreach($data as $recno){
                $stringTm = $stringTm . round($recno->Tn,2) .', '; 
            }
            $stringTm = rtrim($stringTm, ', ');
            $array5[] = [
                'name' => $recno->dia.' '.$day,
                'data' => [$stringTm],
            ];    
        }

        $strarray = json_encode($array5);
        $strarray = str_replace('"name"','name',$strarray);
        $strarray = str_replace('"data"','data',$strarray);
        $strarray = str_replace('["','[',$strarray);
        $strarray = str_replace('"]',']',$strarray);

        $this->charts5 = $strarray;       
        
    }

    public function updatedPeriodo($value){

        $response = Http::get('http://181.198.111.178/api-erp/api/semana-calendario', [
            'periodo' => $this->periodo,
        ]);
        $this->tblsemana = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

    }

    public function loadSemana()
    {        
        $this->charts1="";
        
        //Toneladas
        /*$this->proveedor = DB::connection('sqlsrv')
        ->select('EXEC Prc_Erp_Dashboard_Bascula ?, ?, ?', [$this->periodo, $this->semana, "G2"]);*/
        $response = Http::get('http://181.198.111.178/api-erp/api/fruta-toneladas', [
            'periodo' => $this->periodo,
            'semana' => $this->semana,
            'tipo' => "G2"
        ]);
        $this->proveedor = collect($response->object())
        ->values();

        foreach($this->proveedor as $proveedor){
            $array[] = [
                'name' => $proveedor->nombre,
                'y' => floatVal($proveedor->Tn),
                'drilldown' => null,
            ];
        }
       
        $this->charts1 = json_encode($array);
               
        $this->dispatch('graph-1', ['newObj' => $this->charts1]);
        $this->dispatch('graph-2', ['newObj' => $this->charts2]);
    }
}
