<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VcCuentaContable extends Component
{
    
    public $codigo, $nombre;
    protected $listeners = ['setCuenta'];

    public function mount($caption){

        $tblcia = DB::connection('sqlsrv')->select('exec sp_Gen_SGI_Cias 3');
    
        $this->lnNombre  = $caption;
        $this->lnperiodo = $tblcia[0]->ejercicio;

    }
    
    public function render()
    {
        return view('livewire.vc-cuenta-contable');
    }

    public function buscarCuenta(){
        
        $this->dispatch('show-form');

    }

    public function setCuenta($codCuenta){

        $tblcta = DB::connection('sqlsrv')->table('SGI_Con_Catalogo')
        ->where('ejercicio', $this->lnperiodo)
        ->whereRaw("codigo = '".strval($codCuenta)."'")
        ->first(); 

        $this->cuenta=[
            'codigo' => $tblcta->Codigo,
            'nombre' => $tblcta->Nombre,
        ];
        
        $this->dispatch('hide-form');
    }

}
