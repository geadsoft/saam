<?php

namespace App\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TmRubrosrol;
use App\Models\TdPlanillaRubros;
use App\Models\TmPersonas;
use App\Models\TdHorasExtras;
use App\Models\TmCompania;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class VcPlanillaRubros extends Component
{
    public $tiporolId, $periodoId, $totpersona, $empresa;
    public $tblrecords=[];
    public $rubros=[];
    public $personas=[];
    public $detalle=[];
    public $row=[];
    public $fecha;
    public $lnvalor;

    public function mount() {

        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        $this->empresa = TmCompania::first();
        
    }
    
    
    public function render()
    {
        
        $tblperiodos = TmPeriodosrol::where('aprobado',0)
        ->where('remuneracion','M')
        ->where('procesado',0)
        ->get();

        $this->loadRubros();

        return view('livewire.vc-planilla-rubros',[
            'tblrecords'  => $this->tblrecords,
            'tblperiodos' => $tblperiodos,
            'rubros'      => $this->rubros,
        ]);
    }

    public function add(){

        reset($this->rubros);
        $this->loadRubros();

        $tiporol = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->where('tm_periodosrols.id',$this->periodoId)
        ->first();

        $hextras = TdHorasExtras::query()
        ->select(
            'persona_id',
            DB::raw('SUM(COALESCE(monto25,0))  as monto25'),
            DB::raw('SUM(COALESCE(monto50,0))  as monto50'),
            DB::raw('SUM(COALESCE(monto100,0)) as monto100'),
            DB::raw('SUM(COALESCE(monto25,0) + COALESCE(monto50,0) + COALESCE(monto100,0)) as total')
        )
        ->where('periodorol_id',$this->periodoId)
        ->groupBy('persona_id')
        ->get()
        ->keyBy('persona_id');        
        
        $this->tiporolId = $tiporol['tiporol_id'];
         
        $this->personas = TmPersonas::query()
        ->join("tm_contratos as c","c.persona_id","=","tm_personas.id")
        ->where('tipoempleado_id',$tiporol->tipoempleado_id)
        ->where('tipocontrato_id',$tiporol->tipocontrato_id)
        ->where('c.estado','A')
        ->orderBy('tm_personas.apellidos','asc')
        ->get();

        foreach($this->personas as $personas){

            $personaId = $personas->id;
            $nui = $personas->nui;
            $nombres = $personas->nombres;
            $apellidos = $personas->apellidos;

            $this->tblrecords[$personaId]['persona_id'] = $personaId;
            $this->tblrecords[$personaId]['nui'] = $nui;
            $this->tblrecords[$personaId]['nombre'] = $apellidos.' '.$nombres;

            foreach($this->rubros as $rubro){
                $rubroId = $rubro->id;

                $this->tblrecords[$personaId][$rubroId] = 0;

                if(isset($hextras[$personaId]) && $rubroId==$this->empresa->extra25){
                    $this->tblrecords[$personaId][$rubroId] = $hextras[$personaId]->monto25 ?? 0;
                }

                if(isset($hextras[$personaId]) && $rubroId==$this->empresa->extra50){
                    $this->tblrecords[$personaId][$rubroId] = $hextras[$personaId]->monto50 ?? 0;
                }

                if(isset($hextras[$personaId]) && $rubroId==$this->empresa->extra100){
                    $this->tblrecords[$personaId][$rubroId] = $hextras[$personaId]->monto100 ?? 0;
                }
                              
            }

        }
        
        $this->loadPlanilla();
    }

    public function loadRubros(){

        $this->rubros = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->join("td_tiporol_rubros as tr","tr.tiposrol_id","=","t.id")
        ->join("tm_rubrosrols as r","r.id","=","tr.rubrosrol_id")
        ->where([
            ['r.registro',"NO"],
            ['r.regplanilla',1],
            ['tm_periodosrols.id',$this->periodoId],
        ])
        ->orderBy('r.tipo', 'desc')
        ->orderBy('r.id', 'asc')
        ->get();

    }

    public function loadPlanilla(){

        $planilla = TdPlanillaRubros::where([
            ['tiposrol_id',$this->tiporolId],
            ['periodosrol_id',$this->periodoId],
        ])->get();

        foreach ($planilla as $index => $data){

            $personaId = $data->persona_id;
            $rubroId = $data->rubrosrol_id;

            $this->tblrecords[$personaId][$rubroId] = $data->valor;
        }

    }

    public function createData(){

        $this ->validate([
            'periodoId' => 'required',
            'fecha' => 'required',
        ]);
        
        if (empty($this->tblrecords)){

            $this->periodoId = '';
            $this->dispatch('msg-alerta');
            return;
            
        }

        $tiporol = TmPeriodosrol::find($this->periodoId);
        $this->loadRubros();

        $dataRow=[
            'fecha' => "",
            'tiposrol_id' => 0,
            'periodosrol_id' => 0,
            'persona_id' => 0,
            'rubrosrol_id' => 0,
            'valor' => 0,
            'usuario' => "",
            'estado' => ""
        ];


        foreach ($this->tblrecords as $index => $data)
        {   

            foreach ($this->rubros as $rubro){

                    $dataRow['fecha'] = $this->fecha;
                    $dataRow['tipo'] = 'P';
                    $dataRow['tiposrol_id'] = $tiporol['tiporol_id'];
                    $dataRow['periodosrol_id'] = $this->periodoId;
                    $dataRow['persona_id'] = $index;
                    $dataRow['rubrosrol_id'] = $rubro->id;
                    $dataRow['valor'] = $this->tblrecords[$index][$rubro->id];
                    $dataRow['usuario'] = auth()->user()->name;
                    $dataRow['estado']  = 'G';

                array_push($this->detalle,$dataRow);
            }
                    
        }

        TdPlanillaRubros::query()
        ->where('tiposrol_id',$tiporol['tiporol_id'])
        ->where('periodosrol_id',$this->periodoId)
        ->delete();
        
        TdPlanillaRubros::insert($this->detalle);       
        $this->dispatch('msg-grabar');

        return redirect()->to('/payroll/planilla');

    }

   

}

?>