<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;

class VcBuscarCCosto extends Component
{

    use WithPagination;

    public $componente='';
    public $ccosto, $periodo;
    public $filters;
    
    public function mount($emitTo)
    {
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->periodo = $this->tblperiodo[0]->periodo;
        
        $this->componente = $emitTo;
        /*$response = Http::get('http://181.198.111.178/api-erp/api/centro-costo', [
            'periodo' => $this->periodo,
        ]);
        $this->ccosto = collect($response->object())
        ->values();*/
    }

    public function render()
    {
        if (!empty($this->filters)){
                       
            $response = Http::get('http://181.198.111.178/api-erp/api/buscar-ccosto', [
                'periodo'   => $this->periodo,
                'buscar'    => $this->filters ?? '',
            ]);
            $this->ccosto = collect($response->object())
            ->values(); 
            
            /*$this->ccosto  = DB::connection('sqlsrv')->table('V_SGI_CCosto_Rol')
            ->when($this->filters,function($query){
                return $query->whereRaw("nombre like '%".$this->filters."%'");
            })
            ->where('ejercicio', 2024)
            ->where('superior','>',0)
            ->selectRaw('top 20 * ')
            ->get();*/

        }else{
            $this->ccosto = [];
        }
        
        return view('livewire.vc-buscar-c-costo',[
            'tblccosto' => $this->ccosto,
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function addCCosto($codigo){
        $this->filters="";
        $this->ccosto=[];
        
        //$this->dispatch($this->componente, cuenta:$codCuenta);
        $this->dispatch('setCCosto', codigo:$codigo);
    }
}
