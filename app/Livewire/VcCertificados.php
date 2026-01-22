<?php

namespace App\Livewire;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

use Livewire\Component;

class VcCertificados extends Component
{
    public $cantidad=0, $lnMes=0, $selectId, $tipoMov;
    
    use WithPagination;

    public $tblperiodo, $tblproductos;

    public $meses = [
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

    public $tipoDoc = [
        1 => 'VENTA',
        2 => 'ALMACENAMIENTO',
        3 => 'PESO COMPARTIDOS',
        4 => 'DESECHOS',
        5 => 'MAQUILA',
        6 => 'CONSIGNACIÓN',
        7 => 'DEVOLUCION',
        99 => 'ABASTECIMIENTO',
    ];

    public $filters = [
        'periodo' => '',
        'mes' => '',
        'tab' => 2,
        'producto' => "",
        'documento' => "",
    ];

    public $activeTab=[
        1 => "",
        2 => "",
        3 => "",
        4 => ""
    ];

    public function mount(){
        
        $this->tblperiodo = DB::connection('sqlsrv')->table('SGI_Ctas_Resultados')
        ->orderBy('periodo','desc')
        ->get();

        $ldate = date('Y-m-d H:i:s');
        $this->filters['mes'] = intval(date('m',strtotime($ldate)));
        
        //Productos
        $this->tblproductos = DB::connection('sqlsrv')->table('SGI_Inv_Productos')
        ->select('codigo','nombre')
        ->whereRaw("subgrupo > 0 and fabrica <> ''")
        ->get()->toArray();

        $periodo = $this->tblperiodo->first()->periodo;
        $this->filters['periodo'] = $periodo;

        $this->selectTab(2);
    }

    public function render()
    {
        

        if ( $this->filters['tab'] == 2){

            $tblrecords = DB::connection('sqlsrv')->table('bascula_ventas as v')
            ->where('periodo',$this->filters['periodo'])
            ->where('mes',$this->filters['mes'])
            ->where('certificado',0)
            ->when($this->filters['documento'],function($query){
                return $query->where('Documento','like','%'.$this->filters['documento'].'%');
            })
            //->where('fabrica', 'like', '%estearina%')
            ->orderByRaw('FechaSalida desc,Documento desc')
            ->paginate(6);

        }else{

            $sub = DB::connection('sqlsrv')
            ->table('Erp_Bas_Certificados')
            ->select('peso_id','user_calidad')
            ->where('venta', 1)
            ->orWhere('abastecimiento', 1)
            ->groupBy('peso_id','user_calidad');

            $tblrecords = DB::connection('sqlsrv')
            ->table('bascula_ventas as v')
            ->joinSub($sub, 'c', function ($join) {
                $join->on('c.peso_id', '=', 'v.Id_Fila');
            })
            ->where('periodo',$this->filters['periodo'])
            ->where('mes',$this->filters['mes'])
            //->where('fabrica', 'like', '%CPO%')
            ->orderByRaw('FechaSalida desc,Documento desc')
            ->paginate(6);

        }
    
        return view('livewire.vc-certificados',[
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    #[On('selectTab')]
    public function selectTab($tab){

        $this->activeTab=[
            1 => "",
            2 => "",
        ];

        $this->activeTab[$tab] = "active";
        $this->filters['tab'] = $tab;
    }

    public function delete( $id, $tipo ){
        
        $this->selectId = $id;
        $this->dispatch('show-delete');
        $this->tipoMov = $tipo;
        
    }

     public function deleteData(){

       

        if ($this->tipoMov=='99'){
            DB::connection('sqlsrv')->table('Erp_Bas_Certificados')
            ->where('peso_id',$this->selectId)
            ->where('abastecimiento',true)
            ->delete();

            DB::connection('sqlsrv')
            ->table('inv.Tbl_Tm_AbastecerAlmacen')
            ->where('id_fila', $this->selectId)
            ->update([
                'certificado' => 0
            ]);

        }else{
            
            DB::connection('sqlsrv')->table('Erp_Bas_Certificados')
            ->where('peso_id',$this->selectId)
            ->where('venta',true)
            ->delete();
            
            DB::connection('sqlsrv')
            ->table('inv.Tbl_Tm_Egr_Venta')
            ->where('id_fila', $this->selectId)
            ->update([
                'certificado' => 0
            ]);
        }

        $this->dispatch('hide-delete');
    }

}   
