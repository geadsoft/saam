<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class VcCcostoCuentas extends Component
{
    use WithPagination;

    public $tblperiodo=[], $tbldetalle=[];
    public $datos, $periodo, $area=1, $expandedPostId;

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
        
        $areas = DB::connection('sqlsrv')->table('SGI_CC_Divisiones')
        ->selectRaw("codigo, LTRIM(RTRIM(SUBSTRING(nombre, CHARINDEX('-', nombre) + 1, LEN(nombre)))) as nombre")
        ->where('ejercicio',$this->periodo)
        ->where('superior',0)
        ->orderBy('codigo')
        ->get();
        
        $tblrecords = DB::connection('sqlsrv')
        ->select('EXEC Erp_Con_Inf_CCosto_Ctas ?,?', [$this->periodo,$this->area]);      
        
        return view('livewire.vc-ccosto-cuentas',[
            'tblrecords' => $tblrecords,
            'tblperiodo' => $this->tblperiodo,
            'areas' => $areas
        ]);

    }

    public function filtrar($codigo)
    {
        $this->area = $codigo;
        $this->tab1 = "active All";
        
    }

    public function mostrarDetalle($id,$ccosto,$cuenta){
        
        if ($this->expandedPostId == $id) {
            $this->expandedPostId = null;
            $this->tbldetalle = [];
        } else {
            $this->expandedPostId = $id;
            $this->loadDetalle($ccosto,$cuenta);
        }
    }

    public function loadDetalle($ccosto,$cuenta){

        $this->tbldetalle = DB::connection('sqlsrv')->table('SGI_Con_Cab as c')
        ->join('SGI_Con_Tra as t', 't.numero', '=', 'c.id_fila')
        ->join('SGI_Con_Documentos as dc', 'dc.tipo', '=', 'c.tipo')
        ->select([
            'dc.tipo',
            'dc.nombre',
            'c.fecha',
            'c.documento',
            'beneficiario',
            'observaciones',
            DB::raw("CASE WHEN t.mes = 1 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db01"),
            DB::raw("CASE WHEN t.mes = 1 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr01"),
            DB::raw("CASE WHEN t.mes = 2 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db02"),
            DB::raw("CASE WHEN t.mes = 2 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr02"),
            DB::raw("CASE WHEN t.mes = 3 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db03"),
            DB::raw("CASE WHEN t.mes = 3 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr03"),
            DB::raw("CASE WHEN t.mes = 4 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db04"),
            DB::raw("CASE WHEN t.mes = 4 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr04"),
            DB::raw("CASE WHEN t.mes = 5 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db05"),
            DB::raw("CASE WHEN t.mes = 5 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr05"),
            DB::raw("CASE WHEN t.mes = 6 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db06"),
            DB::raw("CASE WHEN t.mes = 6 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr06"),
            DB::raw("CASE WHEN t.mes = 7 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db07"),
            DB::raw("CASE WHEN t.mes = 7 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr07"),
            DB::raw("CASE WHEN t.mes = 8 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db08"),
            DB::raw("CASE WHEN t.mes = 8 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr08"),
            DB::raw("CASE WHEN t.mes = 9 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db09"),
            DB::raw("CASE WHEN t.mes = 9 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr09"),
            DB::raw("CASE WHEN t.mes = 10 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db10"),
            DB::raw("CASE WHEN t.mes = 10 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr10"),
            DB::raw("CASE WHEN t.mes = 11 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db11"),
            DB::raw("CASE WHEN t.mes = 11 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr11"),
            DB::raw("CASE WHEN t.mes = 12 AND tipovalor = 'DB' THEN t.valor ELSE 0 END as db12"),
            DB::raw("CASE WHEN t.mes = 12 AND tipovalor = 'CR' THEN t.valor ELSE 0 END as cr12"),
        ])
        ->where('t.periodo', $this->periodo)
        ->where('t.CentroCosto',$ccosto)
        ->where('t.cuenta',$cuenta)
        ->where('t.estatus', 'P')
        ->orderBy('t.mes')
        ->get()->toArray();
        
        //dd($this->expandedPostId);
    }

    public function loadAuxiliar($ccosto,$cuenta){

        $url = route('ctas.auxiliar', [
            'periodo' => $this->periodo,
            'ccosto' => $ccosto,
            'cuenta' => $ccosto
        ]);
        $this->dispatch('redirect-to-url', ['url' => $url]);
        //$this->dispatch('redirect-to-url', ['url' => $url]);

    }


}
