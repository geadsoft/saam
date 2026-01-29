<?php

namespace App\Livewire;

use App\Models\TmArea;
use App\Models\TmContratos;
use App\Models\TdVacaciones;
use App\Models\TmCalendarioEventos;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class VcVacaciones extends Component
{
    public $tblperiodos, $vacaciones, $personas, $showEditModal;
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
        $this->diasVacaciones();
        $this->loadEvent();
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
        ->when(filled($this->filters['area']), fn($q) =>
            $q->where('tm_contratos.area_id', $this->filters['area']))
        ->orderBy('apellidos')
        ->get();

        return view('livewire.vc-vacaciones',[
            'departs' => $departs,
            'personas' => $this->personas,
        ]);
    }

    public function diasVacaciones()
    {

        $empleados = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento']))
        ->when(filled($this->filters['area']), fn($q) =>
            $q->where('tm_contratos.area_id', $this->filters['area']))
        ->orderBy('apellidos')
        ->get();

        foreach($empleados as $empleado){
            $this->vacaciones[]=[
                'id' => $empleado->id,
                'empleado' => $empleado->apellidos.' '.$empleado->nombres,
                'area' => $empleado->area->descripcion,
                'departamento' => $empleado->departamento->descripcion,
                'disponibles' => 0,
                'aprobadas' => 0,
                'validacion' => 0,
                'pendientes' => 0,
            ];
        }

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
        $inicio = Carbon::createFromFormat('d-m-Y H:i', $startDate);
        $fin    = Carbon::createFromFormat('d-m-Y H:i', $endDate);

        // Validación básica
        if ($fin->lessThanOrEqualTo($inicio)) {
            throw new \Exception('La fecha/hora final debe ser mayor a la inicial');
        }

            // Total días (laborales o calendario)
        $totalDias = $this->calculaTiempo($inicio,$fin);
        $tiempo = $totalDias;
        $tipoPermiso = 'dias';

        TdVacaciones::Create([
            'persona_id' => $this->record['personaId'],
            'fecha' => $this->record['fecha'],
            'fecha_empieza' => $this->record['fechadesde'],
            'fecha_termina' => $this->record['fechahasta'],
            'observacion' => $this -> record['comentario'],
            'tiempo' => $tiempo.' '.$tipoPermiso,
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

    public function calculaTiempo($inicio,$fin){

        $horasLaboralesPorDia = 8;
        $totalHoras = 0;

        $fecha = $inicio->copy()->startOfDay();

        while ($fecha->lte($fin)) {

            // Saltar fines de semana (opcional)
            if ($fecha->isWeekend()) {
                $fecha->addDay();
                continue;
            }

            $inicioDia = $fecha->copy()->setTime(8, 0);
            $finDia    = $fecha->copy()->setTime(17, 0);

            // Ajustar primer día
            if ($fecha->isSameDay($inicio)) {
                $inicioDia = $inicio;
            }

            // Ajustar último día
            if ($fecha->isSameDay($fin)) {
                $finDia = $fin;
            }

            if ($finDia->greaterThan($inicioDia)) {
                $horasDia = $inicioDia->diffInMinutes($finDia) / 60;

                // Descontar almuerzo (si cruza 12–13)
                if ($inicioDia->lt($fecha->copy()->setTime(12,0)) &&
                    $finDia->gt($fecha->copy()->setTime(13,0))) {
                    $horasDia -= 1;
                }

                $totalHoras += max(0, $horasDia);
            }

            $fecha->addDay();
        }

        $totalDias = round($totalHoras / $horasLaboralesPorDia, 2);
        return $totalDias;
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
