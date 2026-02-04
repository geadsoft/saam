<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Illuminate\Support\Facades\DB;

class AbastecimientoExport implements FromView, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = json_decode($filters, true);
    }

    public function view(): View 
    { 
        $records = DB::connection('sqlsrv')->table('bascula_ventas as v')
        ->where('periodo',$this->filters['periodo'])
        ->where('mes',$this->filters['mes'])
        ->when($this->filters['producto'],function($query){
            return $query->where('v.codigo','like','%'.$this->filters['producto'].'%');
        })
        ->where('TipoEgr','=',99)
        ->orderByRaw('FechaSalida desc,Documento desc')
        ->get();

        return view('export.BasculaAbastecer',[
            'data' => $this->filters,
            'records' => $records,
        ]);
    }
}
