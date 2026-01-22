<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class VcCuentasCcosto extends Component
{   
    use WithPagination;

    public $tblperiodo=[];

    public function mount()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));

        $this->tblperiodo = DB::connection('sqlsrv')->table('SGI_Ctas_Resultados')
        ->orderBy('periodo','desc')
        ->get()->toArray();

        $this->periodo = $this->tblperiodo[0]->periodo;
        //$this->consulta();
    }
    
    public function render()
    {
        $tblrecords = DB::connection('sqlsrv')
        ->select('EXEC Erp_Con_Inf_CCosto_Ctas ?', [$this->periodo]);      
        
        return view('livewire.vc-cuentas-ccosto',[
            'tblrecords' => $tblrecords,
            'tblperiodo' => $this->tblperiodo
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }
}
