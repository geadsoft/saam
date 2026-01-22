<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Illuminate\Support\Facades\DB;

class BasculaTanqueExport implements FromView, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = json_decode($filters, true);
    }

    public function view(): View 
    { 
        $records = DB::connection('sqlsrv')->table('inv.Tbl_Tm_Peso_TanqueBascula')
        ->when($this->filters['buscar'],function($query){
            return $query->where('id_fila','like','%'.$this->filters['buscar'].'%');
        })
        ->whereDate('fecha_salida','>=',$this->filters['fechaini'])
        ->whereDate('fecha_salida','<=',$this->filters['fechafin'])
        ->get();

        return view('export.BasculaTanque',[
            'data' => $this->filters,
            'records' => $records,
        ]);
    }
}
