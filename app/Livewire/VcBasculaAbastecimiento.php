<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class VcBasculaAbastecimiento extends Component
{   
    public $cantidad=0;
    
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
        99 => 'ABASTECIMIENTO',
    ];

    public $filters = [
        'periodo' => 0,
        'mes' => 0
    ];

    public $activeTab=[
        1 => "",
        2 => "",
        3 => "",
        4 => ""
    ];

    public function mount(){
        
        $tblperiodo = DB::connection('sqlsrv')->table('SGI_Ctas_Resultados')
        ->orderBy('periodo','desc')
        ->get()->toArray();

        $ldate = date('Y-m-d H:i:s');
        $this->filters['periodo'] = date('Y',strtotime($ldate));
        $this->filters['mes'] = intval(date('m',strtotime($ldate)));

        $addperiodo = 0;
        foreach($tblperiodo as $recno){
            if($recno->periodo==$this->filters['periodo']){
                $addperiodo = 1;
            }
            $this->tblperiodo[] = $recno->periodo;
        }

        if ($addperiodo==0){
            $this->tblperiodo[] = $this->filters['periodo'];
        }

        //Productos
        $this->tblproductos = DB::connection('sqlsrv')->table('SGI_Inv_Productos')
        ->select('codigo','nombre')
        ->whereRaw("subgrupo > 0 and fabrica <> ''")
        ->get()->toArray();

    }

    public function render()
    {
        
        $tblrecords = DB::connection('sqlsrv')->table('bascula_ventas as v')
        ->where('periodo',$this->filters['periodo'])
        ->where('mes',$this->filters['mes'])
        ->where('TipoEgr','=',99)
        ->orderByRaw('FechaSalida desc,Documento desc')
        ->paginate(6);
        
        return view('livewire.vc-bascula-abastecimiento',[
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
            3 => "",
            4 => ""
        ];

        switch ($tab) {
            case 1:
                $this->activeTab[1] = "active";
                $this->filters['proceso'] = "";
                $this->filters['estado'] = "P";
                $this->filters['patio'] = 0;
                break;
            case 2:
                $this->activeTab[2] = "active";
                $this->filters['proceso'] = "M";
                $this->filters['estado'] = "";
                $this->filters['patio'] = 0;
                break;
            case 3:
                $this->activeTab[3] = "active";
                $this->filters['proceso'] = "";
                $this->filters['estado'] = "C";
                $this->filters['patio'] = 1;
                break;
            case 4:
                $this->activeTab[4] = "active";
                $this->filters['proceso'] = "";
                $this->filters['estado'] = "A";
                $this->filters['patio'] = 1;
                break;
        }


    }
}
