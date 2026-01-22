<?php

namespace App\Livewire;
use App\Models\TdSucursalUsuarios;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class VcBasculaCompras extends Component
{
    use WithPagination;

    public $periodo, $cantidad=0, $TCompras, $TAutomaticos, $TManuales, $TAnulados, $periodos;
    public $sucursal=[];

    public $filters=[
        'buscar' => '',
        'proceso' => '',
        'patio' => 1,
        'estado' => '',
        'sucursal' => '',
        'periodo' => '',
        'mes' => '',
    ];

    public $meses=[
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre',
    ];

    public $activeTab=[
        1 => "",
        2 => "",
        3 => "",
        4 => ""
    ];

    public function mount()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        $this->filters['mes'] = date('m',strtotime($ldate));
        $this->filters['periodo'] = date('Y',strtotime($ldate));

        $tblcia = DB::connection('sqlsrv')
        ->table('sgi_config.dbo.sgi_cias')
        ->where('id_fila',3)
        ->first();
        
        $this->periodo = $tblcia->ejercicio;

        $sql = DB::connection('sqlsrv')
        ->table('sgi_config.dbo.sgi_cias')
        ->where('EntregaFruta','<>','')
        ->get();

        foreach($sql as $key => $cia){
            $this->sucursal[$cia->NumeroCia] = $cia->EntregaFruta;
        }
        $this->sucursal[0] = 'Quevedo';
        $this->selectTab(3);

        //Periodo
        $this->periodos = DB::connection('sqlsrv')
        ->table('SGI_Ctas_Resultados')
        ->get();

        //Sucursal
        $sucursal = TdSucursalUsuarios::where('usuario_id',auth()->user()->id)->first();
       
        $this->config = DB::connection('sqlsrv')
        ->table('sgi_config.dbo.SGI_Usuarios as u')
        ->join('sgi_config.dbo.SGI_Cias as c','u.Sucursal','=','c.NumeroCia')
        ->whereRaw('Sucursal>0 and c.EntregaFruta is not null')
        ->where('u.usuario',$sucursal->usuario)
        ->select('u.Sucursal','ConfigBG','ConfigBP','PuertoG','PuertoP','Oficina')
        ->first();

        $this->filters['sucursal'] =  $this->config->Sucursal;

    }

    public function render()
    {
        $tblrecords = DB::connection('sqlsrv')
        ->table('inv.tbl_tm_pesobascula as b')
        ->join('SGI_Cxp_Catalogo as c','c.Codigo','=','b.CodProveedor')
        ->leftjoin('sgi_inv_haciendas as h','h.Id_Fila','=','b.CodHacienda')
        ->join('sgi_inv_choferes as ch','ch.Id_Fila','=','b.CodChofer')
        ->join('sgi_inv_vehiculos as v','v.Id_Fila','=','b.CodVehiculo')
        ->select('b.Id_Fila','c.Nombre as proveedor','h.Nombre as hacienda','ch.Nombre as chofer','v.Nombre as Vehiculo',
        'Fecha_Ingreso','Hora_Ingreso','Fecha_Salida','Hora_Salida','Peso_Ingreso','Peso_Salida','Peso_Neto','b.Placa','Proceso','Numcia')
        ->when($this->filters['buscar'],function($query){
            return $query->where('c.Nombre', 'like', '%' . $this->filters['buscar'] . '%');
        })
        ->when($this->filters['proceso'],function($query){
            return $query->where('proceso',$this->filters['proceso']);
        })
        ->when($this->filters['patio']>0,function($query){
            return $query->where('Peso_Neto',0);
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('b.Estado',$this->filters['estado']);
        })
        ->when($this->filters['sucursal'],function($query){
            return $query->where('b.Numcia',$this->filters['sucursal']);
        })
        ->when($this->filters['patio']>0,function($query){
            return $query->whereRaw("month(Fecha_Ingreso) = {$this->filters['mes']}");
        })
        ->orderby('Id_Fila','desc')
        ->paginate(15);

        if ($this->filters['patio']>0){
            $this->cantidad = $tblrecords->total();
        }

        return view('livewire.vc-bascula-compras',[
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
