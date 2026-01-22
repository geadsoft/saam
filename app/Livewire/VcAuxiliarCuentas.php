<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class VcAuxiliarCuentas extends Component
{
    use WithPagination;

    public $periodo,$mes,$ccosto,$cuenta;
    
    public function mount($periodo,$cuenta,$ccosto)
    {

        $this->periodo = $periodo;
        $this->ccosto = $ccosto;
        $this->cuenta = $cuenta;
    }
    
    public function render()
    {
        $tblrecords = DB::connection('sqlsrv')->table('SGI_Con_Cab as c')
        ->join('SGI_Con_Tra as t', 't.numero', '=', 'c.id_fila')
        ->join('SGI_Con_Documentos as dc', 'dc.tipo', '=', 'c.tipo')
        ->select([
            'dc.tipo',
            'dc.nombre',
            'c.fecha',
            'c.documento',
            'beneficiario',
            't.detalle as observaciones',
            't.cuenta',
            DB::raw("CASE WHEN tipovalor = 'DB' THEN t.valor ELSE 0 END as debito"),
            DB::raw("CASE WHEN tipovalor = 'CR' THEN t.valor ELSE 0 END as credito")
        ])
        ->where('t.periodo', $this->periodo)
        ->where('t.CentroCosto',$this->ccosto)
        ->where('t.cuenta',$this->cuenta)
        ->where('t.estatus', 'P')
        ->orderBy('t.fecha','desc')
        ->paginate(10);
        
        return view('livewire.vc-auxiliar-cuentas',[
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }
}
