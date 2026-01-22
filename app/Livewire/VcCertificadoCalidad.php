<?php

namespace App\Livewire;
use App\Models\TdSucursalUsuarios;
use App\Models\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class VcCertificadoCalidad extends Component
{
    public $periodo, $selectId, $fechaProduccion, $lote, $fecha, $tblproductos, $responsable, $generado=0, $tipo, $tanque;
    public $etiqueta =false, $empaque =false;
    public $users;

    public $tblcia=[];
    public $tblperiodos=[];
    public $detalle=[];
    public $calidad=[];

    public function mount($tipo,$id)
    {
        $ldate = date('Y-m-d H:i:s');

        $tblcia = DB::connection('sqlsrv')
        ->table('sgi_config.dbo.sgi_cias')
        ->where('id_fila',3)
        ->first();
        
        $this->periodo = $tblcia->ejercicio;
        $this->generado = 0;

        //Periodo
        $this->periodos = DB::connection('sqlsrv')
        ->table('SGI_Ctas_Resultados')
        ->get();

        $this->tblproductos = DB::connection('sqlsrv')->table('SGI_Inv_Productos')
        ->select('codigo','nombre')
        ->whereRaw("subgrupo > 0 and fabrica <> ''")
        ->get()->toArray();

        $this->users = User::role('Calidad')->get();

        $this->selectId = $id;
        $this->tipo = $tipo;
        $this->loadRubros();
    }

    public function render()
    {
        $record = DB::connection('sqlsrv')->table('bascula_ventas as v')
        ->where('Id_Fila',$this->selectId)
        ->first();

        $this->fecha = date('Y-m-d',strtotime($record->FechaSalida)); 
                
        return view('livewire.vc-certificado-calidad',[
            'record' => $record
        ]);
    }

    public function loadRubros(){

       
        if ($this->tipo!="99"){
            $rcalidad =  DB::connection('sqlsrv')->table('erp_inv_rubroscalidad as c')
            ->join("inv.tbl_tm_egr_venta as v","v.codigo","=","c.producto")
            ->where('v.Id_Fila',$this->selectId)
            ->get();
        }else{
            $rcalidad =  DB::connection('sqlsrv')->table('erp_inv_rubroscalidad as c')
            ->join("inv.tbl_tm_abasteceralmacen as v","v.codigo","=","c.producto")
            ->where('v.Id_Fila',$this->selectId)
            ->get();
        }     

        $this->detalle = [];
        
        foreach($rcalidad as $recno){
            $this->detalle[] = [
                'codigo' => $recno->id_fila,
                'nombre' => $recno->nombre,
                'valor' => "",
                'minimo' => $recno->minimo,
                'maximo' => $recno->maximo,
                'metodo' => $recno->metodo,
                'etiqueta' => $recno->etiqueta
            ];
        }

    }

    public function createData(){

        $ldate = date('Ymd H:i:s');
        $detalle = [];

        foreach($this->detalle as $recno){
                
            if (!isset($recno['valor']) || $recno['valor'] == "") {
                continue;
            }
            $detalle[] = [
                'fecha'            => $ldate,
                'fecha_produccion' => date('Ymd H:i:s', strtotime($this->fechaProduccion)),
                'lote'             => $this->lote,
                'rubrocalidad_id'  => $recno['codigo'],
                'valor' => $recno['valor'],
                'peso_id' => $this->selectId,
                'venta' => $this->tipo==99 ? 0 : 1,
                'abastecimiento' => $this->tipo==99 ? 1 : 0,
                'etiqueta' => $this->etiqueta,
                'empaque' => $this->empaque,
                'user_produccion' => $this->responsable,
                'user_calidad' => auth()->user()->name,
                'tanque' => $this->tanque,
                'fecha_Registro'   => null,
                'equipo_Registro'  => null,
                'usuario_Registro' => null,
            ];

        }

        if (!empty($detalle)) {
            DB::connection('sqlsrv')->table('erp_bas_certificados')->insert($detalle);
        }

        // Actualiza campo certificado
        if ($this->tipo!=99){

            DB::connection('sqlsrv')
            ->table('inv.tbl_tm_egr_venta')
            ->where('Id_Fila', $this->selectId)
            ->update([
                'certificado' => 1,
            ]);

        }else{

            DB::connection('sqlsrv')
            ->table('inv.tbl_tm_abasteceralmacen')
            ->where('Id_Fila', $this->selectId)
            ->update([
                'certificado' => 1,
            ]);

        }
            
        $this->imprimir($this->tipo,$this->selectId);
        $this->generado = 1;
    }

    public function imprimir($tipo,$id)
    {
        $url = route('Certificado.pdf', [$tipo,$id]);
        $this->dispatch('imprimir', url: $url);
    }

    public function add()
    {
        $this->calidad=[
            'nombre' => '',
            'minimo' => 0,
            'maximo' => 0,
            'metodo' => '',
            'etiqueta' => ''
        ];

        $this->dispatch('show-form');
    }

    public function createRubro()
    {
        DB::connection('sqlsrv')->table('Erp_Inv_RubrosCalidad')->insert($this->calidad);
        $this->dispatch('hide-form');
        $this->loadRubros();
    }

}
