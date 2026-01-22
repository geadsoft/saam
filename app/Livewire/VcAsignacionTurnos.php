<?php

namespace App\Livewire;
use App\Models\TmArea;
use App\Models\TmCargocia;
use App\Models\TmCatalogogeneral;
use App\Models\TmTurnosHorarios;
use App\Models\TmContratos;
use App\Models\TdEmpleadosTurnos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class VcAsignacionTurnos extends Component
{
    public $selectValue, $addNew = false, $control="disabled",$turnos; 
    public $turnoId = null;
    public $tblrecords=[];
    public $tblvariable=[];
    public $fechas = [];

    public $record=[
        'turno_id' => null,
        'reemplaza' => '',
        'horasextras'  => '',
        'alimentacion'  => '',
    ];

    public $filters=[
        'area' => 1,
        'departamento' => 2,
        'empleado' => '',
        'cargo' => '',
        'fechaini' => '',
        'fechafin' => '',
        'turno' => 'TF',
    ];

    public $turnoHorario=[
        'hora_entrada' => '00:00',
        'hora_salida' => '00:00',
        'dias' => [],
        'tipo' => 'Diurno',
    ];

    public $diasSemana = [
        'lunes' => ['dia' => 'L', 'aplica' => 'S'],
        'martes' => ['dia' => 'M', 'aplica' => 'S'],
        'miercoles' => ['dia' => 'M', 'aplica' => 'S'],
        'jueves' => ['dia' => 'J', 'aplica' => 'S'],
        'viernes' => ['dia' => 'V', 'aplica' => 'S'],
        'sabado' => ['dia' => 'S', 'aplica' => 'S'],
        'domingo' => ['dia' => 'D', 'aplica' => 'S'],
        'feriado' => ['dia' => 'F', 'aplica' => 'S'],
        'dialibre' => ['dia' => 'DL', 'aplica' => 'S'],
    ];

    public function mount()
    {   
        $this->consulta();
    }

    public function render()
    {   
        $this->turnos =  TmTurnosHorarios::query()
        ->when($this->filters['departamento'],function($query){
            return $query->where('area_id',$this->filters['departamento']);
        })->get();        

        $areas  = TmArea::query()
        ->whereRaw('area_id is null')
        ->get();

        $departs  = TmArea::query()
        ->whereRaw('area_id > 0')
        ->get();

        $templeados = TmCatalogogeneral::query()
        ->where('superior',1)
        ->get();

        $cargos = TmCargocia::all();

        return view('livewire.vc-asignacion-turnos',[
            'turnos' => $this->turnos,
            'areas' => $areas,
            'departs' => $departs,
            'cargos' => $cargos,
            'templeados' => $templeados
        ]);
    }

    public function consulta()
    {
        //$this->tblrecords = [];
        $this->tblrecords = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->join('tm_areas as a','a.id','=','tm_contratos.area_id')
        ->leftJoin('td_empleados_turnos as et','et.persona_id','=','p.id')
        ->leftJoin('tm_turnos_horarios as t','t.id','=','et.turno_id')
        ->when(filled($this->filters['area']), fn($q) =>
            $q->where('tm_contratos.area_id', $this->filters['area'])
        )
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento'])
        )
        ->when(filled($this->filters['cargo']), fn($q) =>
            $q->where('tm_contratos.cargo_id', $this->filters['cargo'])
        )
        ->when(filled($this->filters['empleado']), fn($q) =>
            $q->where('tm_contratos.tipoempleado_id', $this->filters['empleado'])
        )
        ->selectRaw('p.nui,p.nombres,p.apellidos,a.descripcion as area,0 as seleccion,t.descripcion as turno,p.id')
        ->orderBy('p.apellidos')
        ->get()->toArray();
        
        if($this->addNew==true){
            $this->tblrecords = TmContratos::query()
            ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
            ->join('tm_areas as a','a.id','=','tm_contratos.area_id')
            ->when(filled($this->filters['area']), fn($q) =>
                $q->where('tm_contratos.area_id', $this->filters['area'])
            )
            ->when(filled($this->filters['departamento']), fn($q) =>
                $q->where('tm_contratos.departamento_id', $this->filters['departamento'])
            )
            ->when(filled($this->filters['cargo']), fn($q) =>
                $q->where('tm_contratos.cargo_id', $this->filters['cargo'])
            )
            ->when(filled($this->filters['empleado']), fn($q) =>
                $q->where('tm_contratos.tipoempleado_id', $this->filters['empleado'])
            )
            ->selectRaw('p.nui,p.nombres,p.apellidos,a.descripcion as area,0 as seleccion,"" as turno,p.id')
            ->orderBy('p.apellidos')
            ->get()->toArray();
        }
        
    }

    public function add(){
        
        $this->addNew = true;
        $this->turnos =  TmTurnosHorarios::query()
        ->where('area_id',$this->filters['departamento'])
        ->get();

        $this->record = [
            'turno_id'     => null,
            'fechaini'     => '',
            'fechafin'     => '',
            'reemplaza'    => '',
            'horasextras'  => '',

        ];

        $this->control = '';
        $this->turnoId = ''; 
        $this->filters['turno'] = 'TF';
        $this->consulta();

    }

    public function selectTurno()
    {

        $turno = TmTurnosHorarios::query()
        ->join('tm_horarios as h','h.id','=','tm_turnos_horarios.horario_id')
        ->select('h.entrada','h.salida','h.nocturno','tm_turnos_horarios.dias_extra')
        ->where('tm_turnos_horarios.id',$this->record['turno_id'])
        ->first();
        
        if ($turno) {
            $this->turnoHorario['hora_entrada'] = $turno->entrada;
            $this->turnoHorario['hora_salida']  = $turno->salida;
            $this->turnoHorario['dias']         = json_decode($turno->dias_extra, true); // array o string
            $this->turnoHorario['tipo']         = $turno->nocturno == 0 ? 'Diurno' : 'Nocturno';
        }
        
        foreach ($this->turnoHorario['dias'] as $value) {
           $this->diasSemana[$value]['aplica'] = 'N';
        }
        
    }

    public function allEmpleados(){

        foreach ($this->tblrecords as $key => $item) {
            $this->tblrecords[$key]['seleccion'] = $this->tblrecords[$key]['seleccion'] == 0 ? true : false;
        }

    }

    public function createData()
    {
        if($this->filters['turno']=='TF'){
            $this->validate([
                'record.turno_id' => 'required',
                'record.fechaini' => 'required|date',
                'record.fechafin' => 'required|date|after_or_equal:record.fechaini',
            ]);
        }
            
        $haySolapamiento = !$this->validarSolapamientoTurno();
        $reemplaza = (bool) ($this->record['reemplaza'] ?? false);

        if ($haySolapamiento && !$reemplaza) {
            return;
        }

        if($this->filters['turno']=='TV'){
            $this->createTurnos();
            return;
        }

        $userName = auth()->user()->name;
        $turnoId = $this->record['turno_id'];
        $fechaInicio = $this->record['fechaini'];
        $fechaFin = $this->record['fechafin'];
        $horasExtras = $this->record['horasextras'];
        $reemplaza = $this->record['reemplaza'];

        foreach ($this->tblrecords as $item) {

            $personaId = $item['id'];
            $seleccion = $item['seleccion'] ?? null;

            // Buscar turno activo para esta persona que se solape con las fechas dadas
            $turnoExistente = TdEmpleadosTurnos::where('persona_id', $personaId)
            ->where('estado', 'A')
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                    ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin])
                    ->orWhere(function ($q) use ($fechaInicio, $fechaFin) {
                        $q->where('fecha_inicio', '<=', $fechaInicio)
                            ->where('fecha_fin', '>=', $fechaFin);
                    });
            })
            ->first();

            if ($seleccion === 0) {
                // Si hay un turno activo en el rango, cambiar estado a Inactivo
                if ($turnoExistente) {
                    if($reemplaza==true){
                        $turnoExistente->update([
                            'turno_id' => $turnoId,
                            'fecha_inicio' => $fechaInicio,
                            'fecha_fin' => $fechaFin,
                            'usuario' => $userName,
                            'updated_at' => now(),
                        ]);
                    }else{
                        $turnoExistente->update([
                            'estado' => 'I',
                            'usuario' => $userName,
                            'updated_at' => now(),
                        ]);
                    }
                }
            } elseif ($seleccion == 1 || $seleccion === true) {
                // Si seleccion true y NO tiene turno activo en rango, crear uno nuevo con estado 'A'
                if (!$turnoExistente) {
                    TdEmpleadosTurnos::create([
                        'persona_id' => $personaId,
                        'turno_id' => $turnoId,
                        'fecha_inicio' => $fechaInicio,
                        'fecha_fin' => $fechaFin,
                        'estado' => 'A',
                        'horas_extras' => $horasExtras,
                        'usuario' => $userName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->dispatch('msg-grabar');
    }

    public function createTurnos(){

        $userName = auth()->user()->name;
        $fechaInicio = $this->record['fechaini'];
        $fechaFin = $this->record['fechafin'];
        $horasExtras = $this->record['horasextras'];
        $reemplaza = $this->record['reemplaza'];    
    
        DB::transaction(function () use ($fechaInicio, $fechaFin, $horasExtras, $userName, $reemplaza) {

            foreach ($this->tblvariable as $personaId => $record) {

                // Obtener turnos activos de la persona en el rango
                $turnosExistentes = TdEmpleadosTurnos::where('persona_id', $personaId)
                    ->where('estado', 'A')
                    ->where(function ($q) use ($fechaInicio, $fechaFin) {
                        $q->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                        ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin])
                        ->orWhere(function ($q2) use ($fechaInicio, $fechaFin) {
                            $q2->where('fecha_inicio', '<=', $fechaInicio)
                                ->where('fecha_fin', '>=', $fechaFin);
                        });
                    })
                    ->get()
                    ->keyBy(fn($t) => $t->fecha_inicio->format('Ymd'));

                $inserts = [];

                foreach ($this->fechas as $fecha) {

                    $key = $fecha;
                    $turnoId = $record[$key] ?? null;

                    if (!$turnoId) {
                        continue;
                    }

                    // Si existe turno ese día
                    if (isset($turnosExistentes[$key])) {

                        if ($reemplaza) {
                            $turnosExistentes[$key]->update([
                                'turno_id' => $turnoId,
                                'fecha_inicio' => date('Y-m-d',strtotime($fecha)),
                                'fecha_fin' => date('Y-m-d',strtotime($fecha)),
                                'usuario' => $userName,
                                'updated_at' => now(),
                            ]);
                        }

                        continue;
                    }

                    // Preparar inserción
                    $inserts[] = [
                        'persona_id'   => $personaId,
                        'turno_id'     => $turnoId,
                        'fecha_inicio' => date('Y-m-d',strtotime($fecha)),
                        'fecha_fin'    => date('Y-m-d',strtotime($fecha)),
                        'estado'       => 'A',
                        'horas_extras' => $horasExtras,
                        'usuario'      => $userName,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ];
                }

                // Inserción masiva
                if (!empty($inserts)) {
                    TdEmpleadosTurnos::insert($inserts);
                }
            }
        });

        $this->dispatch('msg-grabar');
    }

    public function validarSolapamientoTurno()
    {
        $turnoId = $this->record['turno_id'];
        $fechaInicio = $this->record['fechaini'];
        $fechaFin = $this->record['fechafin'];

        $personasSeleccionadas = collect($this->tblrecords)
            ->where('seleccion', true)
            ->pluck('id');

        $turnosSolapados = TdEmpleadosTurnos::whereIn('persona_id', $personasSeleccionadas)
            ->where('turno_id', $turnoId)
            ->where('estado', 'A')
            ->where(function ($q) use ($fechaInicio, $fechaFin) {
                $q->where('fecha_inicio', '<=', $fechaFin)
                ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->with('persona:id,nombres,apellidos') // si tienes relación
            ->get();

        if ($turnosSolapados->isNotEmpty()) {

            $detalle = $turnosSolapados->map(function ($t) {
                return "{$t->persona->apellidos} {$t->persona->nombres} 
                ({$t->fecha_inicio} - {$t->fecha_fin})";
            })->implode("\n");

            $this->dispatch('msg-error', 
                "No se puede asignar el turno.\n
                Existen solapamientos con los siguientes registros:\n{$detalle}"
            );

            return false;
        }

        return true;
    }

    public function generarDias()
    {
        $this->tblvariable=[];
        //$this->tblrecords=[];

        $this->turnos =  TmTurnosHorarios::query()
        ->where('area_id',$this->filters['departamento'])
        ->get();
    
        if($this->record['fechaini']=='' || $this->record['fechafin']==''){
            return; 
        }
        
        $this->fechas = [];

        $personas = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->join('tm_areas as a','a.id','=','tm_contratos.area_id')
        ->leftJoin('td_empleados_turnos as et','et.persona_id','=','p.id')
        ->leftJoin('tm_turnos_horarios as t','t.id','=','et.turno_id')
        ->when(filled($this->filters['area']), fn($q) =>
            $q->where('tm_contratos.area_id', $this->filters['area'])
        )
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento'])
        )
        ->when(filled($this->filters['cargo']), fn($q) =>
            $q->where('tm_contratos.cargo_id', $this->filters['cargo'])
        )
        ->when(filled($this->filters['empleado']), fn($q) =>
            $q->where('tm_contratos.tipoempleado_id', $this->filters['empleado'])
        )
        ->selectRaw('p.nui,p.nombres,p.apellidos,a.descripcion as area,0 as seleccion,t.descripcion as turno,p.id')
        ->orderBy('p.apellidos')
        ->get()->toArray();

        $fechaInicio = Carbon::parse($this->record['fechaini']);
        $fechaFin    = Carbon::parse($this->record['fechafin']);
        $fecha = $fechaInicio->copy();

        while ($fecha->lte($fechaFin)) {
            $this->fechas[] = $fecha->format('d-m-Y');
            $fecha->addDay();
        }

        foreach($personas as $persona){
            $personId = $persona['id'];

            $this->tblvariable[$personId]['nui'] = $persona['nui'];
            $this->tblvariable[$personId]['nombres'] = $persona['apellidos'].' '.$persona['nombres'];
            $this->tblvariable[$personId]['area'] = $persona['area'];            
            foreach($this->fechas as $data){
                $this->tblvariable[$personId][$data] = 0;
            }
        }

        $this->filters['turno'] = 'TV';
        $this->record['horasextras'] = true;
        $this->loadTurnos();
        

       
        
    }

    public function loadTurnos()
    {
        $fechaInicio = $this->record['fechaini'];
        $fechaFin = $this->record['fechafin'];

        $personasSeleccionadas = collect($this->tblrecords)
        ->pluck('id');
    
        $turnoExistente = TdEmpleadosTurnos::query()
        ->where('estado', 'A')
        ->where('fecha_inicio','>=',$fechaInicio)
        ->where('fecha_fin','<=',$fechaFin)
        ->whereIn('persona_id', $personasSeleccionadas)
        ->get();

        foreach($turnoExistente as $data){
            $fechaini = date('d-m-Y',strtotime($data->fecha_inicio));
            $fechafin = date('d-m-Y',strtotime($data->fecha_fin));
            $personaId = $data->persona_id;
        
            if ($fechaini==$fechafin){
                $this->tblvariable[$personaId][$fechaini] = $data->turno_id;
            }else{

                $starDate = Carbon::parse($data->fecha_inicio);
                $endDate  = Carbon::parse($data->fecha_fin);
                $fecha = $starDate->copy();
                
                while ($fecha->lte($endDate)) {
                    $column = date('d-m-Y',strtotime($fecha));
                    $this->tblvariable[$personaId][$column] = $data->turno_id;
                    $fecha->addDay();
                }

            }           
            
        }

    }

}