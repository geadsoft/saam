<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;

class VcBusqueda extends Component
{
    public $periodo, $table, $campo, $result;
    public $filters;

    public $arrcampo = [
        'sgi_con_catalogo'  => 'cuenta',
        'sgi_cc_divisiones' => 'ccosto',
    ]; 
    
    public function mount($tabla)
    {
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->periodo = $this->tblperiodo[0]->periodo;
        $this->table = $tabla;

    }
    
    public function render()
    {
        if (!empty($this->filters)){
            
            $response = Http::get('http://181.198.111.178/api-erp/api/consulta', [
                'tabla'   => $this->table,
                'periodo' => $this->periodo,
                'buscar'  => $this->filters ?? '',
            ]);
            $this->result = collect($response->object())
            ->values(); 

        }else{
            $this->result = [];
        }
        
        return view('livewire.vc-busqueda',[
            'result' => $this->result,
        ]);
    }

    #[On('setTabla')]
    public function setTabla($tabla){
        $this->table = $tabla;
    }

    public function loadDato($recno){
        
        $data = $this->result[$recno];
        $this->campo =  $this->arrcampo[$this->table];

        $this->filters="";
        $this->result = [];
        
        $this->dispatch('mostrar', recno:$data, campo:$this->campo);              
    }
}
