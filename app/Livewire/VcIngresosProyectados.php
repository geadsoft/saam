<?php

namespace App\Livewire;

use App\Models\TdIngresosProyectados;
use App\Models\TmRubrosrol;
use Livewire\Attributes\On;

use Livewire\Component;

class VcIngresosProyectados extends Component
{
    public $ingresos=[];
    public $rubros=[];

    //protected $listeners = ['setGrabar','setLoad'];
    
    public function mount($personaId)
    {
        $this->rubros = TmRubrosrol::query()
        ->where('registro',"NO")
        ->where('regplanilla',0)
        ->get();

        $this->personaId = $personaId;
        $this->loadIngresos();
    }
    
    public function render()
    {
        return view('livewire.vc-ingresos-proyectados');
    }

    public function add(){
        
        $newIng=[];
        $linea = count($this->ingresos);
        $linea = $linea+1;

        $newIng['id']=0;
        $newIng['persona_id']= $this->personaId;
        $newIng['rubro_id']= 0;
        $newIng['nombre']= '';
        $newIng['linea']= $linea;
        $newIng['valor_mes']= 0;
        $newIng['valor_dia']= 0;
        return $newIng;
    }

    public function addLine(){
        $addline = $this->add();
        array_push($this->ingresos,$addline);
    }

    #[On('setIngresos')]
    public function setIngresos($personaId){
        $this->personaId = $personaId;
        $this->reset(['ingresos']);
        $this->loadIngresos();
    }

    public function loadIngresos(){
        
        
        $record = TdIngresosProyectados::where('persona_id',$this->personaId)->get();

        foreach($record as $index => $recno){
            $data=$this->add();
            $data['id'] = $recno['id'];
            $data['persona_id'] = $this->personaId;
            $data['rubro_id']  = $recno['rubro_id'];
            $data['nombre']  = '';
            $data['valor_mes'] = $recno['valor_mes'];
            $data['valor_dia'] = $recno['valor_dia'];
               
            array_push($this->ingresos,$data);
        }

    }

    public function setGrabar(){

        $this->createData();  

    }

    public function createData(){
        
        foreach($this->ingresos as $data){

            if ($data['id']==0){
                
                TdIngresosProyectados::Create([
                    'persona_id' => $this->personaId,
                    'rubro_id' => $data['rubro_id'],
                    'linea' => $data['linea'],
                    'valor_mes' => $data['valor_mes'],
                    'valor_dia' => $data['valor_dia'],
                    'usuario' => auth()->user()->name,
                    'estado' => 'A',
                ]);

            }else{

                $record = TdIngresosProyectados::find($data['id']);

                $record->update([
                    'rubro_id' => $data['rubro_id'],
                    'valor_mes' => $data['valor_mes'],
                    'valor_dia' => $data['valor_dia'],
                ]);

            }

        }
        
    }

}
