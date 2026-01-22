<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class VcCuentasProvision extends Component
{
    public $tipoCuenta = '';
    public $periodo = '';

    //protected $listeners = ['setCuenta'];
    
    public function mount(){
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->periodo = $this->tblperiodo[0]->periodo;
    }
        
    public function render()
    {
        return view('livewire.vc-cuentas-provision');
    }

    public function buscarCuenta($tipoCuenta){
        
        $this->tipoCuenta = $tipoCuenta;
        $this->dispatch('show-form');

    }

    #[On('setCuenta')]
    public function setCuenta($cuenta){

        $response = Http::get('http://181.198.111.178/api-erp/api/buscar-ctasrol', [
            'periodo'   => $this->periodo,
            'buscar'    => $cuenta ?? '',
        ]);
        $tblcta = collect($response->object());
        $tblcta = $tblcta[0];
       
        switch ($this->tipoCuenta){
            case 'PAI':
                $this->ctapai = $cuenta;
                $this->nompai = $tblcta->Nombre;
                break;
            case 'PAP':
                $this->ctapap  = $cuenta;
                $this->nompap = $tblcta->Nombre;
                break;
            case 'PAS':
                $this->ctapas = $cuenta;
                $this->nompas = $tblcta->Nombre;
                break;
            case 'PIE':
                $this->ctapie = $cuenta;
                $this->nompie = $tblcta->Nombre;
                break;
            case 'PB13':
                $this->ctab13 = $cuenta;
                $this->nomb13 = $tblcta->Nombre;
                break;
            case 'PB14':
                $this->ctab14 = $cuenta;
                $this->nomb14 = $tblcta->Nombre;
                break;
            case 'PB14':
                $this->ctab14 = $cuenta;
                $this->nomb14 = $tblcta->Nombre;
                break;
            case 'PBVA':
                $this->ctabvac = $cuenta;
                $this->nombvac = $tblcta->Nombre;
                break;
            case 'PBFR':
                $this->ctabfre = $cuenta;
                $this->nombfre= $tblcta->Nombre;
                break;
        }

        $this->dispatch('hide-form');

    }

}
