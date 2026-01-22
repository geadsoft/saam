<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;


class VcBuscarCuentas extends Component
{
    use WithPagination;

    public $componente='';
    public $cuentas, $periodo;
    public $filters;
    
    public function mount($target)
    {
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->periodo = $this->tblperiodo[0]->periodo;
        
        $this->componente = $target;
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-contables', [
            'periodo' => $this->periodo,
        ]);
        $this->cuentas = collect($response->object())
        ->values();
    }

    public function render()
    {
        if (!empty($this->filters)){
            
            $response = Http::get('http://181.198.111.178/api-erp/api/buscar-ctasrol', [
                'periodo'   => $this->periodo,
                'buscar'    => $this->filters ?? '',
            ]);
            $this->cuentas = collect($response->object())
            ->values();            

        }else{
            $this->cuentas = [];
        }
        
        return view('livewire.vc-buscar-cuentas',[
            'tblcuentas' => $this->cuentas,
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function addCuenta($codCuenta){

        $this->emitTo($this->componente,'setCuenta',$codCuenta);
        
       
    }

}
