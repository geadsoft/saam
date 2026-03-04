<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Illuminate\Support\Facades\DB;

class CertificadosExport implements FromView, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = json_decode($filters, true);
    }

    public function view(): View 
    {
        if ( $this->filters['tab'] == 2){

            $tblrecords = DB::connection('sqlsrv')->table('bascula_ventas as v')
            ->where('periodo',$this->filters['periodo'])
            ->where('mes',$this->filters['mes'])
            ->where('certificado',0)
            ->when($this->filters['documento'],function($query){
                return $query->where('Documento','like','%'.$this->filters['documento'].'%');
            })
            ->orderByRaw('FechaSalida desc,Documento desc')
            ->get();

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
            ->when($this->filters['producto'],function($query){
                return $query->where('v.item',$this->filters['producto']);
            })
            ->orderByRaw('FechaSalida desc,Documento desc')
            ->get();

            $ids = $tblrecords->pluck('Id_Fila')->toArray();

            $detalles = DB::connection('sqlsrv')
            ->table('Erp_Bas_Certificados as c')
            ->join('Erp_Inv_RubrosCalidad as r', 'r.id_fila', '=', 'c.rubrocalidad_id')
            ->select(
                'lote',
                'r.nombre',
                'valor',
                'user_calidad',
                'peso_id as pesoId'
            )
            ->whereIn('c.peso_id', $ids)
            ->get();

            $detallesAgrupados = $detalles->groupBy('pesoId');

        }

        return view('export.certificadocalidad',[
            'data' => $this->filters,
            'records' => $tblrecords,
            'detallesAgrupados' => $detallesAgrupados,
        ]);
    }
}

