<?php

namespace App\Livewire;

use App\Models\TmPersonas;
use App\Models\TmArea;
use App\Models\TmContratos;
use App\Models\TdSolicitudVacaciones;
use App\Models\TmCalendarioEventos;
use App\Services\VacationService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Livewire\Component;
use Livewire\WithPagination;

class VcVacaciones extends Component
{
    use WithPagination;

    public $tblperiodos, $personas, $showEditModal, $periodoContable, $selectValue, $selectId;
    public $arrevent, $record=[];

    public $estado=[
        'S' => ['estado' => 'Solicitado','color' => 'badge-soft-warning'],
        'A' => ['estado' => 'Aprobado','color' => 'badge-soft-success'],
        'D' => ['estado' => 'Denegada','color' => 'badge-soft-danger'],
    ];

    public $filters=[
        'periodo' => '',
        'area' => '',
        'departamento' => '',
        'buscar' => '',
        'tab' => 'vacaciones'      
    ];

    public function mount()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->record['fecha'] = date('Y-m-d',strtotime($ldate));

        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodos = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->filters['periodo'] = $this->tblperiodos[0]->periodo;
        //$this->diasVacaciones();
        //$this->loadEvent();
    }

    public function render()
    {
        $departs  = TmArea::query()
        ->whereRaw('area_id > 0')
        ->get();

        $this->personas = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento']))
        ->when($this->filters['buscar'],function($query){
            return $query->where('nombres','like','%'.$this->filters['buscar'].'%')
                        ->orWhere('apellidos','like','%'.$this->filters['buscar'].'%');
        })
        ->orderBy('apellidos')
        ->get();

        $vacaciones = $this->diasVacaciones();

        $tblrecords = TdSolicitudVacaciones::query()
        ->join('tm_personas as p','p.id','=','td_solicitud_vacaciones.persona_id')
        ->join('tm_contratos as c','c.persona_id','=','p.id')
        ->join('tm_cargocias as cc','c.cargo_id','=','cc.id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('c.departamento_id', $this->filters['departamento']))
        ->when($this->filters['buscar'],function($query){
            return $query->where('p.nombres','like','%'.$this->filters['buscar'].'%')
                        ->orWhere('p.apellidos','like','%'.$this->filters['buscar'].'%');
        })
        ->select('p.nombres','p.apellidos','cc.descripcion as cargo','td_solicitud_vacaciones.*')
        ->paginate(12);

        return view('livewire.vc-vacaciones',[
            'departs' => $departs,
            'personas' => $this->personas,
            'vacaciones' => $vacaciones,
            'tblrecords' => $tblrecords,
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function diasVacaciones()
    {
        $vacaciones = TmContratos::query()
        ->join('tm_personas as p', 'p.id', '=', 'tm_contratos.persona_id')
        ->join('tm_areas as a','tm_contratos.area_id','=','a.id')
        ->join('tm_areas as d','tm_contratos.departamento_id','=','d.id')
        ->leftJoinSub(
            DB::table('td_periodo_vacaciones')
                ->selectRaw('persona_id, SUM(dias_generados - dias_usados) AS disponibles')
                ->groupBy('persona_id'),
            'pv',
            'pv.persona_id',
            '=',
            'p.id'
        )

        ->leftJoinSub(
            DB::table('td_solicitud_vacaciones')
                ->selectRaw("
                    persona_id,
                    SUM(CASE WHEN estado = 'A' THEN dias ELSE 0 END) AS aprobadas,
                    SUM(CASE WHEN estado = 'S' THEN dias ELSE 0 END) AS solicitadas
                ")
                ->groupBy('persona_id'),
            'sv',
            'sv.persona_id',
            '=',
            'p.id'
        )
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('d.departamento_id', $this->filters['departamento']))
        ->when($this->filters['buscar'],function($query){
            return $query->where('p.nombres','like','%'.$this->filters['buscar'].'%')
                        ->orWhere('p.apellidos','like','%'.$this->filters['buscar'].'%');
        })
        ->select(
            'p.id',
            'p.nombres',
            'p.apellidos',
            'p.foto',
            'a.descripcion as area',
            'd.descripcion as departamento',
            DB::raw('COALESCE(pv.disponibles, 0) AS disponibles'),
            DB::raw('COALESCE(sv.aprobadas, 0) AS aprobadas'),
            DB::raw('COALESCE(sv.solicitadas, 0) AS solicitadas')
        )
        ->orderBy('p.apellidos')
        ->paginate(12);
        
    
        return $vacaciones;

    }

    public function loadEvent(){

        $this->eventos = TmCalendarioEventos::query()
        ->selectRaw('tm_calendario_eventos.*, DATE(DATE_ADD(end_date, INTERVAL 1 DAY)) as fecha2')
        ->get();

        $this->arrayObject($this->eventos);

    }

    public function add(){
        
        $this->showEditModal = false;
        $this->record['personaId']= 0;
        $this->record['fechadesde']= '';
        $this->record['fechahasta']= ''; 
        $this->record['comentario']= ''; 
        $this->record['estado']= 'S';

        $this->dispatch('show-form');
        
    }

    public function createData(){
        
        $this ->validate([
            'record.fecha' => 'required',
            'record.personaId' => 'required',
            'record.fechadesde' => 'required',
            'record.fechahasta' => 'required',
        ]);

        $startDate = date('d-m-Y',strtotime($this->record['fechadesde']));
        $endDate = date('d-m-Y',strtotime($this->record['fechahasta']));
        $inicio = Carbon::createFromFormat('d-m-Y', $startDate);
        $fin    = Carbon::createFromFormat('d-m-Y', $endDate);

        // Validación básica
        if ($fin->lessThanOrEqualTo($inicio)) {

            $this->addError('fecha_fin', 'La fecha/hora final debe ser mayor a la inicial.');
            return;
        }

        // Total días (laborales o calendario)
        $totalDias = $this->calculaTiempo($inicio,$fin);
        $tiempo = $totalDias;
        $tipoPermiso = 'dias';

        TdSolicitudVacaciones::Create([
            'persona_id' => $this->record['personaId'],
            'fecha' => $this->record['fecha'],
            'fecha_empieza' => $this->record['fechadesde'],
            'fecha_termina' => $this->record['fechahasta'],
            'observacion' => $this -> record['comentario'],
            'dias' => $tiempo,
            'estado' => 'S',
            'usuario' => auth()->user()->name,
        ]);

        $mes = date('m', strtotime($this->record['fecha']));
        $periodo = date('Y', strtotime($this->record['fecha']));
        $persona = TmPersonas::find($this->record['personaId']);

        $eventos = TmCalendarioEventos::Create([
            'periodo' => $periodo,
            'mes' => $mes,
            'actividad' => 'VA',
            'nombre' => $persona->apellidos.' '.$persona->nombres,
            'start_date' => $this->record['fechadesde'],
            'end_date' => $this->record['fechahasta'],
            'descripcion' => $this -> record['comentario'],
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatch('hide-form'); 
        $this->dispatch('msg-grabar');
    }

    //Aprobar Solicitud
    public function aprobar($requestId)
    {
        $result  = TdSolicitudVacaciones::find($requestId);
        $this->selectValue = $result->persona->apellidos.' '.$result->persona->nombres;
        $this->selectId = $result->id;
        $this->dispatch('show-aprobar');
    }

    public function aprobarVacaciones()
    {
        DB::transaction(function () {

            $request = TdSolicitudVacaciones::lockForUpdate()->findOrFail($this->selectId);

            if ($request->estado !== 'S') {
                throw new \Exception('Solicitud ya gestionada');
                return;
            }

            $diasDisponibles = VacationService::getAvailableDays($request->persona_id);

            if ($request->dias > $diasDisponibles) {
                throw new \Exception('Días insuficientes');
                return;
            }

            VacationService::consumeDaysFIFO($request);

            $request->estado = 'A';
            $request->save();
        });

        $this->dispatch('hide-aprobar');
    }
        
    //Elimina Solicitudes Aprobadas
    public function deleteAprobada($requestId)
    {
        DB::transaction(function () use ($requestId) {

            $request = VacationRequest::lockForUpdate()->findOrFail($requestId);

            if ($request->estado !== 'APROBADA') return;

            $movements = VacationMovement::where('vacation_request_id', $request->id)->get();

            foreach ($movements as $movement) {
                $period = VacationPeriod::find($movement->vacation_period_id);
                $period->dias_usados -= $movement->dias;
                $period->save();
            }

            VacationMovement::where('vacation_request_id', $request->id)->delete();

            $request->estado = 'ANULADA';
            $request->save();
        });

        $this->emit('vacationUpdated');
    }

    public function calculaTiempo($inicio,$fin){

        if ($fin->lessThan($inicio)) {
            return 0;
        }

        return $inicio->startOfDay()->diffInDays($fin->startOfDay()) + 1;

    }

    public function arrayObject($eventos){

        $array=[
            'id' =>  0,
            'title' => '',
            'start' => $this->record['fecha'],
            'className' => 'bg-soft-success',
            'location' => '',
            'allDay' => false,
            'extendedProps' => ['department'=>'All Day Event'],
            'description' => ''
        ];

        foreach ($eventos as $key => $event){

            $fecha1 = date('Y-m-d',strtotime($event['start_date']));
            $fecha2 = date('Y-m-d',strtotime($event['end_date']));
            $color = "bg-soft-success";

            $array[] = [
                'id' =>  $event['id'],
                'title' => $event['nombre'],
                'start' => $fecha1,
                'end' => $fecha2,
                'className' => $color,
                'location' => '',
                'allDay' => true,
                'extendedProps' => ['department'=>'All Day Event'],
                'description' => $event['descripcion'] 
            ];
            
        }
        
        $this->arrevent = json_encode($array);     
        $this->dispatch('load-calendar', events: $array);
        
    }
}
