<?php

namespace App\Livewire;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\BasculaTanqueExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

$primerDia = Carbon::now()->startOfMonth()->toDateString();
$ultimoDia = Carbon::now()->endOfMonth()->toDateString();

use Livewire\Component;

class VcBasculaTanque extends Component
{   
    use WithPagination;

    public $filters=[
        'fechaini' => '',
        'fechafin' => '',
        'buscar' => '',
    ];
   
    public function mount(){

        $this->filters['fechaini'] = Carbon::now()->startOfMonth()->toDateString();
        $this->filters['fechafin'] = Carbon::now()->endOfMonth()->toDateString();
    }

    public function render()
    {
        $tblrecords = DB::connection('sqlsrv')->table('inv.Tbl_Tm_Peso_TanqueBascula')
        ->when($this->filters['buscar'],function($query){
            return $query->where('id_fila','like','%'.$this->filters['buscar'].'%');
        })
        ->whereDate('fecha_salida','>=',$this->filters['fechaini'])
        ->whereDate('fecha_salida','<=',$this->filters['fechafin'])
        ->orderby('id_fila','desc')
        ->paginate(12);
        
        return view('livewire.vc-bascula-tanque',[
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function exportExcel(){

        $data = json_encode($this->filters);
        return Excel::download(new BasculaTanqueExport($data), 'Pesos en Tanque Bascula.xlsx');

    }

}
