<?php

namespace App\Livewire;
use App\Models\TmTiposrol;
use App\Models\TmRubrosrol;
use App\Models\TmCuentasContables;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class VcEnlaceContables extends Component
{
    
    use WithPagination;
    public $selectId, $nomtiporol="", $showEditModal=false, $edit=false, $periodo;
    public $tiporolId=1, $tipoPago='M', $rubroId, $codCuenta, $naturaleza, $comprobante='N', $ccostoId=0, $gDeducible=false;
    public $tbltiposrols, $tmCuentas, $nomCuenta, $codCCosto=0, $nomCCosto, $utilizaCC=0, $selectValue, $campo;
    public $classnavD = 'nav-link fs-15 p-3 active';
    public $classnavC = 'nav-link fs-15 p-3 ';
    public $classtabD = 'tab-pane fade show active';
    public $classtabC = 'tab-pane fade ';
    
    public $arrayNaturaleza = [
        'D' => 'Débito',
        'C' => 'Crédito'
    ];

    public $arrPago = [
        'Q' => 'Quincenal',
        'M' => 'Mensual'
    ];

    public $arrayComprobante = [
        'N' => 'Nómina',
        'P' => 'Provisión'
    ];

    public $arrRubro = [
        'TI' => 'TOTAL INGRESOS',
        'TE' => 'TOTAL EGRESOS',
        'TP' => 'TOTAL A PAGAR',
    ];

    public function mount()
    {
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->periodo = $this->tblperiodo[0]->periodo;
        
        $this->tbltiposrols = TmTiposrol::all();

        $this->tiporolId  = $this->tbltiposrols[0]['id'];
        $this->nomtiporol = $this->tbltiposrols[0]['descripcion'];
        $this->naturaleza = 'D';
    }
        
    public function render()
    {
        if ($this->edit==false){
            $tblrubros    = TmRubrosrol::query()
            ->leftJoin('tm_cuentas_contables as t', function($join)
            {
                $join->on('t.rubro_id', '=', 'tm_rubrosrols.id');
                $join->on('t.tiporol_id', '=',DB::raw($this->tiporolId));
                $join->on('t.remuneracion', '=',DB::raw("'".$this->tipoPago."'"));
                $join->on('t.tipo', '=',DB::raw("'".$this->naturaleza."'"));
            })
            ->select('tm_rubrosrols.*')
            ->whereRaw("tm_rubrosrols.estado='A' and t.rubro_id is null")
            ->orderby('tm_rubrosrols.descripcion')
            ->get();
        }else{
            $tblrubros    = TmRubrosrol::query()
            ->where('id',$this->rubroId)
            ->get();
        }

        $tblrecords   = TmCuentasContables::where('tiporol_id',$this->tiporolId)
        ->where('remuneracion',$this->tipoPago)
        ->where('tipo',$this->naturaleza)
        ->paginate(8);

        return view('livewire.vc-enlace-contables',[
            'tbltiposrols' => $this->tbltiposrols,
            'tblrecords'   => $tblrecords,
            'tblrubros'    => $tblrubros
        ]);
        

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function load(){

        $this->rubroId  = 0;
        $this->codCuenta = '';
        $this->nomCuenta = '';
		$this->codCCosto = 0;
        $this->nomCCosto = '';
		$this->comprobante = 'N';
        $this->gDeducible = false;
        $this->edit = false;
    }


    public function add(){
        
        $this->showEditModal = false;

        $this->rubroId=0; 
        $this->codCuenta=''; 
        $this->naturaleza='D'; 
        $this->comprobante='N'; 
        $this->codCCosto=0; 
        $this->gDeducible=false;
          
        $this->dispatch('show-form');
        
    }

    public function edit($record){
       
        $this->edit=true;
        $this->selectId   = $record['id'];

        $tblcta = DB::connection('sqlsrv')->table('SGI_Con_Catalogo')
        ->where('ejercicio', 2024)
        ->whereRaw("codigo = '".$record['cuenta']."'")
        ->first();

        $this->utilizaCC = $tblcta->UtilizaCC;
        
        $this->tiporolId  = $record['tiporol_id'];
        $this->rubroId= $record['rubro_id'];
        $this->codCuenta= $record['cuenta']; 
        $this->nomCuenta= $record['descripcion']; 
        $this->naturaleza= $record['tipo']; 
        $this->comprobante= $record['comprobante']; 
        $this->codCCosto= $record['ccosto'];  
        $this->gDeducible=false;

        //$this->dispatch('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmCuentasContables::find($this->selectId);    
        $this->selectValue = $record['descripcion'];

        $this->dispatch('show-delete');

    }

    public function consulta($valor){
        
        $this->dispatch('setTabla', tabla:$valor); 
        $this->dispatch('show-form');

    }

    public function tipoCta($tipo){

        $this->naturaleza = $tipo;

        if ($tipo=='C'){
            $this->classnavD = 'nav-link fs-15 p-3 ';
            $this->classnavC = 'nav-link fs-15 p-3 active';
            $this->classtabD = 'tab-pane fade ';
            $this->classtabC = 'tab-pane fade show active';
        }else {
            $this->classnavD = 'nav-link fs-15 p-3 active';
            $this->classnavC = 'nav-link fs-15 p-3 ';
            $this->classtabD = 'tab-pane fade show active';
            $this->classtabC = 'tab-pane fade ';            
        }

    }

    #[On('mostrar')]
    public function mostrar($recno, $campo){

        if($campo=='cuenta'){
            $this->codCuenta = $recno['codigo'];
            $this->nomCuenta = $recno['nombre'];
        }

        if($campo=='ccosto'){
            $this->codCCosto = $recno['codigo'];
            $this->nomCCosto = $recno['nombre'];
        }
                
        $this->dispatch('hide-form');
    }


    public function createData(){ 
        
        if ($this->utilizaCC == 1 & $this->codCCosto==0){
            $this->dispatch('msg-ccosto');
            return;
        }
        
        $this ->validate([
            'tiporolId' => 'required',
            'tipoPago' => 'required',
            'rubroId' => 'required',
            'naturaleza' => 'required',
            'comprobante' => 'required',
        ]);

        switch ($this -> rubroId){
            case 'TI':
                $rubroPago = $this -> rubroId;
                $rubroId = null;
                break;
            case 'TE':
                $rubroPago = $this -> rubroId;
                $rubroId = null;
                break;
            case 'TP':
                $rubroPago = $this -> rubroId;
                $rubroId = null;
                break;
            default:
                $rubroPago = null;
                $rubroId = $this -> rubroId;
                break;
        }       

        $tmpcuenta = TmCuentasContables::Create([
            'tiporol_id' => $this -> tiporolId,
            'remuneracion' => $this-> tipoPago,
            'rubro_id' => $rubroId,
            'rubro_pago' => $rubroPago,
            'cuenta' => $this->codCuenta,
            'descripcion' => $this->nomCuenta,
            'tipo' => $this->naturaleza,
            'comprobante' => $this -> comprobante,
            'ccosto' => $this -> codCCosto,
            'gastodeducible' => $this -> gDeducible,
            'usuario' => auth()->user()->name,
            'estado' => "A",
        ]);

        $this->dispatch('msg-grabar');  
        $this->load();

    }

    public function updateData(){

        if ($this->utilizaCC == 1 & $this->codCCosto==0){
            $this->dispatch('msg-ccosto');
            return;
        }

        $this ->validate([
            'tiporolId' => 'required',
            'tipoPago' => 'required',
            'rubroId' => 'required',
            'naturaleza' => 'required',
            'comprobante' => 'required',
        ]);      
        
        $record = TmCuentasContables::find($this->selectId);
        $record->update([
            'comprobante' => $this -> comprobante,
            'cuenta' => $this->codCuenta,
            'descripcion' => $this->nomCuenta,
            'ccosto' => $this -> codCCosto,
            'gastodeducible' => $this -> gDeducible,
        ]);
            
        $this->dispatch('msg-actualizar');
        $this->load();
    }
    
    public function deleteData(){

        $record = TmCuentasContables::find($this->selectId);
        $record->delete();

        $this->dispatch('hide-delete');
    }


}
