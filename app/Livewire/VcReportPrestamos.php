<?php

namespace App\Livewire;
use App\Models\TrPrestamosCabs;
use App\Models\TmArea;
use App\Models\TmCompania;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class VcReportPrestamos extends Component
{
    use WithPagination;

    public $filters=[
        'startDate' => '',
        'endDate' => '',
        'area' => '',
        'estado' => '',
        'nombre' => '',
    ];
    
    public function mount()
    {
        $hoy = Carbon::now();

        $this->filters['startDate'] = $hoy->copy()->startOfMonth()->format('Y-m-d');
        $this->filters['endDate']   = $hoy->copy()->endOfMonth()->format('Y-m-d');

    }

    public function render()
    {
        $areas  = TmArea::query()
        ->whereRaw('area_id > 0')
        ->get();

        $tblrecords = TrPrestamosCabs::from('tr_prestamos_cabs as c')
        ->join(DB::raw("(
            select p.id as personaid, p.apellidos, p.nombres, c.departamento_id 
            from tm_personas p
            inner join tm_contratos c on c.persona_id = p.id
            where c.estado = 'A'
            ) e
        "),'e.personaid','=','c.persona_id')
        ->join('tm_rubrosrols as r','r.id','=','c.rubrosrol_id')
        ->leftJoin(DB::raw("
            (
                SELECT prestamo_id, COUNT(id) AS pagos, sum(valor) as cancelado
                FROM tr_prestamos_dets
                WHERE estado = 'C'
                GROUP BY prestamo_id
            ) p
        "), 'p.prestamo_id', '=', 'c.id')
        ->leftJoin(DB::raw("
        (
                SELECT prestamo_id, MAX(fecha) AS ultfecha
                FROM tr_prestamos_dets
                GROUP BY prestamo_id
            ) u
        "), 'u.prestamo_id', '=', 'c.id')
        ->when($this->filters['area'],function($query){
            return $query->where('e.departamento_id',$this->filters['area']);
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('c.estado',$this->filters['estado']);
        })
        ->when(
            !empty($this->filters['startDate']) && !empty($this->filters['endDate']),
            function ($query) {
                return $query->whereBetween('c.fecha', [
                    $this->filters['startDate'],
                    $this->filters['endDate']
                ]);
            }
        )
        ->select('c.*', 'u.ultfecha', 'p.pagos', 'e.apellidos', 'e.nombres', 'p.cancelado', 'r.etiqueta')
        ->paginate(12);

        return view('livewire.vc-report-prestamos',[
            'tblrecords' => $tblrecords,
            'areas' => $areas,
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function printData(){

        $datos = json_encode($this->filters);
        $this->dispatch('report-prestamos',data:$datos);

    }

    public function impresion(){

        $results = TrPrestamosCabs::from('tr_prestamos_cabs as c')
        ->join(DB::raw("(
            select p.id as personaid, p.apellidos, p.nombres, c.departamento_id 
            from tm_personas p
            inner join tm_contratos c on c.persona_id = p.id
            where c.estado = 'A'
            ) e
        "),'e.personaid','=','c.persona_id')
        ->join('tm_rubrosrols as r','r.id','=','c.rubrosrol_id')
        ->leftJoin(DB::raw("
            (
                SELECT prestamo_id, COUNT(id) AS pagos, sum(valor) as cancelado
                FROM tr_prestamos_dets
                WHERE estado = 'C'
                GROUP BY prestamo_id
            ) p
        "), 'p.prestamo_id', '=', 'c.id')
        ->leftJoin(DB::raw("
        (
                SELECT prestamo_id, MAX(fecha) AS ultfecha
                FROM tr_prestamos_dets
                GROUP BY prestamo_id
            ) u
        "), 'u.prestamo_id', '=', 'c.id')
        ->when($this->filters['area'],function($query){
            return $query->where('e.departamento_id',$this->filters['area']);
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('c.estado',$this->filters['estado']);
        })
        ->when(
            !empty($this->filters['startDate']) && !empty($this->filters['endDate']),
            function ($query) {
                return $query->whereBetween('c.fecha', [
                    $this->filters['startDate'],
                    $this->filters['endDate']
                ]);
            }
        )
        ->select('c.*', 'u.ultfecha', 'p.pagos', 'e.apellidos', 'e.nombres', 'p.cancelado', 'r.etiqueta')
        ->get();

        return $results;
    }

    public function downloadPDF($objdata){

        $data = json_decode($objdata);
        $this->filters=[
            'startDate' => $data->startDate,
            'endDate' => $data->endDate,
            'area' => $data->area,
            'estado' => $data->estado,
            'nombre' => $data->nombre,
        ];

        $records = $this->impresion();
        $estado=[
            'C' => 'Cancelados',
            'P' => 'Pendientes'
        ];

        $nomArea = '';
        $tblarea = TmArea::find($data->area);
        if ($data){
           $nomArea = $tblarea->descripcion; 
        }

        $title = [
            'fechaini' => date('d/m/Y',strtotime($data->startDate)),
            'fechafin' => date('d/m/Y',strtotime($data->endDate)),
            'area' =>  $nomArea,
            'estado' => ($data->estado=="") ? 'Todos' : $estado[$data->estado],
            'empleado' => ($data->nombre=='') ? ' ' : $data->nombre,
        ];

        $total=[
            'monto' => $records->sum('monto'),
            'cancelado' => $records->sum('cancelado'),
            'saldo' => 0,
        ];
        $total['saldo'] = $total['monto']-$total['cancelado'];


        //Datos Cia
        $objCia = TmCompania::first()
        ->toArray();

        $pdf = PDF::loadView('reports/reporte_prestamos',[
            'tblcia' => $objCia,
            'title' => $title,
            'records' => $records,
            'total' => $total,
        ]); 

        return $pdf->setPaper('A4')->stream('Reporte de Prestamos.pdf');

    }


}
