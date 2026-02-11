<?php

namespace App\Livewire;
use App\Models\TcRolPagos;
use App\Models\TcComprobanteRol;
use App\Models\TdComprobanteRol;
use App\Models\TmCuentasContables;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VcComprobanteRol extends Component
{
    public $detalle = [], $nomina, $diario, $documento;
    public $rolpagoId, $tipo, $comprobanteId, $fecha, $totalDebe, $totalHaber, $diferencia; 

    public $mes = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    ];

    public $tipodoc = [
        'N' => 'Diario de Nomina',
        'P' => 'Diario de Provisión'
    ];
    
    public function mount($id, $tipo){

        $this->rolpagoId = $id;
        $this->tipo = $tipo;

        $tcrolPago = TcRolPagos::find($id);
        

        if ($this->tipo=='P'){
            $this->comprobanteId = $tcrolPago['diarioProvision_id'];
        }else{
            $this->comprobanteId = $tcrolPago['diarioNomina_id'];
        }

        $this->loadData();

    }
    
    public function render()
    {
        return view('livewire.vc-comprobante-rol');
    }

    public function loadData(){

        reset($this->detalle);

        $this->nomina = TcRolPagos::query()
        ->where('id',$this->rolpagoId)
        ->first();
        
        $this->diario= TcComprobanteRol::find($this->comprobanteId);
        $this->fecha = date('Y-m-d',strtotime($this->diario['fecha']));

        $this->detalle = TdComprobanteRol::query()
        ->join('view_cuentas_contables as c','c.cuenta','=','td_comprobante_rols.cuenta')
        ->select('td_comprobante_rols.*','c.descripcion')
        ->where('comprobante_id',$this->comprobanteId)
        ->get();

        $this->totalDebe  = $this->detalle->where('naturaleza','D')->sum('valor');
        $this->totalHaber = $this->detalle->where('naturaleza','D')->sum('valor');
        $this->diferencia = $this->totalDebe-$this->totalHaber;

    }

    public function procesar(){
        
        $fecha   = strtotime($this->fecha);
        /*DB::connection('sqlsrv')->table('SGI_Con_Cab')->insert(
            array(
                   'id_cia' =>   '2', 
                   'mes'    =>   date('m',$fecha),
                   'periodo' => date('Y',$fecha),
                   'tipo'    => 'DN',
                   'documento' => '',
                   'fecha'   => date('Ymd',strtotime($this->diario['fecha'])),
                   'observaciones' => $this->diario['observacion'],
                   'debito' => $this->diario['debito'],
                   'credito' => $this->diario['credito'],
                   'estatus' => 'C',
                   'modulo' => 'ROL',
                   'Id_Origen' =>$this->diario['id'], 
                   'usuario_registro' => null,
                   'equipo_registro' => null,
                   'fecha_registro' => null
            )
       );

       $conCab  = DB::connection('sqlsrv')->table('SGI_Con_Cab')
        ->where('Id_Origen',$this->diario['id'])
        ->where('tipo','DN')
        ->first();  

       foreach($this->detalle as $key => $cuenta){
        
            $conTra = DB::connection('sqlsrv')->table('SGI_Con_Tra')->insert(
                array(
                    'numero' => $conCab->id_fila,
                    'id_cia' =>   '2', 
                    'tipo'    =>  $cuenta['tipo'],
                    'periodo' => date('Y',$fecha),
                    'mes' => date('m',$fecha),
                    'fecha'   => date('Ymd',strtotime($this->diario['fecha'])),
                    'linea' =>$key+1,
                    'cuenta'    => $cuenta['cuenta'],
                    'detalle'   => $cuenta['detalle'],
                    'tipovalor' => $cuenta['naturaleza'],
                    'valor'     => $cuenta['valor'],
                    'estatus' => 'C',
                    'GastoDeducible' => $cuenta['deducible'],
                    'CentroCosto' => $cuenta['ccosto'],
                    'usuario_registro' => '',
                    'equipo_registro' => '',
                    'fecha_registro' => '',
                    )
                );
       }*/

       $this->diario->update([
        'documento' => $conCab->documento,
        'estado' => 'P',
        ]);

        $this->loadData();

    }
}
