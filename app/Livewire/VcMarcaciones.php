<?php

namespace App\Livewire;
use App\Models\TmContratos;
use App\Models\TdTimbres;
use App\Models\TdEmpleadosTurnos;
use App\Models\TmArea;
use App\Models\TdHorasExtras;
use App\Models\TmPeriodosrol;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VcMarcaciones extends Component
{
    public $fecha, $tblrecords=[],  $tblextras=[], $record;

    public $filters=[
        'startDate' => '',
        'endData' => '',
        'departamento' => '2',
        'tab' => 'timbres',
        'periodoRolId' => '',
        'empleadoId' => '',
    ];

    public $feriados = [
        '2025-12-25', // Navidad
        '2026-01-01', // Año Nuevo
        '2026-02-16', //Carnaval
        '2026-02-17', //Carnaval
        '2026-04-03', //Vierne Santo
        '2026-05-01', //Dia del Trabajo
        '2026-05-25', //Batalla del Pichincha
        '2026-08-10', //Primer Grito
        '2026-10-09', //Independencia Gye
        '2026-11-02', //Difuntos
        '2026-11-03', //Cuenca
        '2026-12-25', //Navidad
    ];

    public $diasSemana = [
        'lunes' => 'Lunes',
        'martes' => 'Martes',
        'miercoles' => 'Miércoles',
        'jueves' => 'Jueves',
        'viernes' => 'Viernes',
        'sabado' => 'Sábado',
        'domingo' => 'Domingo',
    ];

    public function mount() {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
    }

    public function getTimbres() {
       
        $response = Http::withHeaders([
            'X-API-KEY' => env('LOCAL_SYNC_API_KEY')
        ])->get('http://181.198.111.178/api-erp/api/leer-marcaciones');

        dd($response->json());
    }

    public function render()
    {
        $departs  = TmArea::query()
        ->whereRaw('area_id > 0')
        ->get();

        $periodoRol = TmPeriodosrol::query()
        ->join('tm_tiposrols as tr','tr.id','=','tm_periodosrols.tiporol_id')
        ->where('aprobado',0)
        ->where('remuneracion','M')
        ->where('procesado',0)
        ->where('tr.tipoempleado_id',$this->filters['empleadoId'])
        ->select('tm_periodosrols.*')
        ->get();

        $empleados = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento']))
        ->orderBy('apellidos')
        ->get();

        return view('livewire.vc-marcaciones',[
            'departs' => $departs,
            'empleados' => $empleados,
            'periodoRol' => $periodoRol,
        ]);
    }

    public function add(){
        
        $this->record['codigo']= 0;
        $this->record['descripcion']= '';
        $this->record['superior']= 0;
        $this->record['estado']= 'A'; 
        $this->record['root']= '';       
        $this->dispatch('show-form');

    }

    public function marcaciones(){

        $timbres = TdTimbres::query()
        ->whereBetween('fecha', [$this->filters['startDate'], $this->filters['endDate']])
        ->where('estado','A')
        //->where('codigo','205712605')
        ->orderBy('codigo')
        ->orderBy('fecha_hora', 'asc')
        ->get()->toArray();

        $turnos = TdEmpleadosTurnos::query()
        ->join('tm_personas as e','e.id','=','td_empleados_turnos.persona_id')
        ->join('tm_turnos_horarios as t','t.id','=','td_empleados_turnos.turno_id')
        ->join('tm_horarios as h','h.id','=','t.horario_id')
        ->selectRaw('t.*,h.entrada,h.salida,nocturno,h.ini_descanso, h.fin_descanso,td_empleados_turnos.fecha_inicio,td_empleados_turnos.fecha_fin,right(e.nui,9) as nui,e.nombres,e.apellidos')
        ->where('td_empleados_turnos.fecha_inicio','<=',$this->filters['endDate'])
        ->where('td_empleados_turnos.fecha_fin','>=',$this->filters['startDate'])
        ->get();
        
        $bloques = [];
        $entradaActual = [];
        $observaciones = [];

        /* ================================
        TURNOS INDEXADOS POR EMPLEADO
        ================================ */
        $turnosIndexados = $turnos->groupBy('nui');

        /* ================================
        ORDENAR TIMBRES (MUY IMPORTANTE)
        ================================ */
        $timbres = collect($timbres)->sortBy('fecha_hora');

        foreach ($timbres as $timbre) {

            $codigo  = $timbre['codigo'];          // NUI
            $accion  = $timbre['funcion'];         // 0 = entrada, 1 = salida
            $tmanual = is_null($timbre['created_at']) ? 'N' : 'S';

            $fechaHoraTimbre = Carbon::parse($timbre['fecha']);
            $marcaTimbre = Carbon::parse($timbre['fecha_hora']);
            $fechaTimbre = $marcaTimbre->toDateString();

            if (
                isset($entradaActual[$codigo]) &&
                isset($fechaEntradaActual[$codigo]) &&
                $fechaEntradaActual[$codigo] !== $fechaTimbre
            ) {
                $fechaTrabajoAnterior = $entradaActual[$codigo]['fechaTrabajo'];
                $ultimoIndex = count($bloques[$codigo][$fechaTrabajoAnterior]) - 1;

                $bloques[$codigo][$fechaTrabajoAnterior][$ultimoIndex]['salida'] = null;

                $observaciones[$codigo][$fechaTrabajoAnterior][] =
                    'Entrada sin salida (cierre automático por cambio de día)';

                unset($entradaActual[$codigo]);
                unset($fechaEntradaActual[$codigo]);
            }

            $turnosEmpleado = $turnosIndexados[$codigo] ?? collect();

            /* =================================================
            ENTRADA → aquí se determina el TURNO y la FECHA
            ================================================= */
            if ($accion == 0) {

                if (isset($entradaActual[$codigo]) && isset($bloques[$codigo][$fechaTrabajo])) {
                    
                    if($bloques[$codigo][$fechaTrabajo][0]['entrada']!=""){
                        $observaciones[$codigo][$fechaTimbre][] =
                        'Entrada duplicada ignorada';
                        continue;
                    }

                }

                $turnoData = $this->obtenerTurnoAsignado($turnosEmpleado, $fechaHoraTimbre);

                if (!$turnoData) {
                    $observaciones[$codigo][$fechaTimbre][] = 'Sin turno asignado';
                    continue;
                }

                $turnoAsignado = $turnoData['turno'];
                $fechaTrabajo  = $turnoData['fechaTrabajo'];

                $entradaActual[$codigo] = [
                    'fechaTrabajo' => $fechaTrabajo,
                    'turno'        => $turnoAsignado,
                    'timbre'       => $marcaTimbre,
                ];

                $bloques[$codigo][$fechaTrabajo][] = [
                    'emanual' => $tmanual,
                    'entrada' => $marcaTimbre,
                    'smanual' => '',
                    'salida'  => '',
                    'turno'   => $turnoAsignado->id,
                ];
            }

            /* ======================================
            SALIDA → NO se vuelve a buscar turno
            ====================================== */
            if ($accion == 1) {
                
                // 🔹 CASO 1: salida SIN entrada previa
                if (!isset($entradaActual[$codigo])) {

                    // usar la fecha real del timbre como fecha de trabajo
                    $fechaTrabajo = $fechaTimbre;

                    $turnoData = $this->obtenerTurnoAsignado($turnosEmpleado, $fechaHoraTimbre);

                    if (!$turnoData) {
                        $observaciones[$codigo][$fechaTimbre][] = 'Sin turno asignado';
                        continue;
                    }

                    $turnoAsignado = $turnoData['turno'];

                    // crear bloque huérfano
                    $bloques[$codigo][$fechaTrabajo][] = [
                        'emanual' => '',
                        'entrada' => '',
                        'smanual' => $tmanual,
                        'salida'  => $marcaTimbre,
                        'turno'   => $turnoAsignado->id,
                    ];

                    $observaciones[$codigo][$fechaTrabajo][] = 'Salida sin entrada';
                    continue;
                }

                if(isset($entradaActual[$codigo]) && $entradaActual[$codigo]['fechaTrabajo']!=$fechaTimbre){

                    $fechaTrabajo = $fechaTimbre;

                    $turnoData = $this->obtenerTurnoAsignado($turnosEmpleado, $fechaHoraTimbre);

                    if (!$turnoData) {
                        $observaciones[$codigo][$fechaTimbre][] = 'Sin turno asignado';
                        continue;
                    }

                    $turnoAsignado = $turnoData['turno'];

                    // crear bloque huérfano
                    $bloques[$codigo][$fechaTrabajo][] = [
                        'emanual' => '',
                        'entrada' => '',
                        'smanual' => $tmanual,
                        'salida'  => $marcaTimbre,
                        'turno'   => $turnoAsignado->id,
                    ];

                    $observaciones[$codigo][$fechaTrabajo][] = 'Salida sin entrada';
                    unset($entradaActual[$codigo]);
                    continue;

                }

                // 🔹 CASO 2: salida normal (con entrada)
                $fechaTrabajo = $entradaActual[$codigo]['fechaTrabajo'];

                $ultimoIndex = count($bloques[$codigo][$fechaTrabajo]) - 1;

                $bloques[$codigo][$fechaTrabajo][$ultimoIndex]['smanual'] = $tmanual;
                $bloques[$codigo][$fechaTrabajo][$ultimoIndex]['salida'] = $marcaTimbre;          

                unset($entradaActual[$codigo]);
            }
        }
              

        /* ======================================
        CERRAR BLOQUES SIN SALIDA (OPCIONAL)
        ====================================== */
        foreach ($entradaActual as $codigo => $data) {

            $fechaTrabajo = $data['fechaTrabajo'];
            $ultimoIndex = count($bloques[$codigo][$fechaTrabajo]) - 1;

            if (
                isset($bloques[$codigo][$fechaTrabajo][$ultimoIndex]) &&
                empty($bloques[$codigo][$fechaTrabajo][$ultimoIndex]['salida'])
            ) {
                $bloques[$codigo][$fechaTrabajo][$ultimoIndex]['salida'] = null;

                $observaciones[$codigo][$fechaTrabajo][] =
                    'Entrada sin salida (cierre automático fin de procesamiento)';
            }
        }


        //Marcaciones
        $empleados = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->join('tm_areas as a','a.id','=','tm_contratos.area_id')
        ->join('tm_cargocias as c','c.id','=','tm_contratos.cargo_id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento'])
        )
        ->selectRaw('p.id, p.nombres, p.apellidos, right(p.nui,9) as nui, a.descripcion as departamento,
        c.descripcion as cargo, tm_contratos.sueldo, tm_contratos.tipoempleado_id')
        ->orderBy('apellidos')
        ->get();

        foreach($empleados as $fila => $empleado){

            $nui = $empleado->nui;
            $personaId = $empleado->id;         

            $starDate = Carbon::parse($this->filters['startDate']);
            $endDate  = Carbon::parse($this->filters['endDate'])->subDay();
            
            $fecha = $starDate->copy();

            $turnosEmpleado = $turnosIndexados[$nui] ?? collect();
            
            while ($fecha->lte($endDate)) {
                
                $dia = date('Y-m-d',strtotime($fecha));
                $fechaHoraTimbre = Carbon::parse($fecha);
                
                $turnoData = $this->obtenerTurnoAsignado($turnosEmpleado, $fechaHoraTimbre);
                
                $turnoAsignado = null;
                if ($turnoData) {
                    $turnoAsignado = $turnoData['turno'];
                }

                $this->tblrecords[]=[
                    'linea'  => $fila+1,
                    'personaId' => $personaId,
                    'codigo' => $nui,
                    'nombre' => $empleado->apellidos.' '.$empleado->nombres,
                    'depart' => $empleado->departamento,
                    'cargo'  => $empleado->cargo,
                    'sueldo' => $empleado->sueldo,
                    'fecha' => date('d/m/Y',strtotime($fecha)),
                    'turnoId' => 0,
                    'turno' => "",
                    'emanual' => "",
                    'entrada' => "",
                    'timbre1' => "",
                    'salalim' => "", 
                    'timbre2' => "",
                    'entalim' => "",
                    'timbre3' => "",
                    'smanual' => "",
                    'salida'  => "",
                    'timbre4' => "",
                ];

                $index = count($this->tblrecords) - 1;

                if(!empty($turnoAsignado)){
                    $this->tblrecords[$index]['turnoId']= $turnoAsignado['id'];
                    $this->tblrecords[$index]['turno']= $turnoAsignado['descripcion'];
                    $this->tblrecords[$index]['entrada']= $turnoAsignado['entrada'];
                    $this->tblrecords[$index]['salida']= $turnoAsignado['salida'];
                    $this->tblrecords[$index]['salalim']= $turnoAsignado['ini_descanso'];
                    $this->tblrecords[$index]['entalim']= $turnoAsignado['fin_descanso'];
                }

                if(isset($bloques[$nui][$dia])){
                    $this->tblrecords[$index]['emanual']= $bloques[$nui][$dia][0]['emanual'];
                    $this->tblrecords[$index]['timbre1']= $bloques[$nui][$dia][0]['entrada'];
                    $this->tblrecords[$index]['smanual']= $bloques[$nui][$dia][0]['smanual'];
                    $this->tblrecords[$index]['timbre4']= $bloques[$nui][$dia][0]['salida'];
                }

                $fecha->addDay();
                
            }

        }

        $this->filters['empleadoId'] = $empleado['tipoempleado_id'];

    }

    function obtenerTurnoAsignado($turnosEmpleado, Carbon $fechaHoraTimbre)
    {
           
        foreach ($turnosEmpleado as $turno) {

            // validar rango de vigencia del turno
            if (!$fechaHoraTimbre->between(
                Carbon::parse($turno->fecha_inicio)->startOfDay(),
                Carbon::parse($turno->fecha_fin)->endOfDay()
            )) {
                continue;
            }

            // construir inicio del turno
            $inicioTurno = Carbon::parse(
                $fechaHoraTimbre->toDateString() . ' ' . $turno->hora_inicio
            );

            $finTurno = Carbon::parse(
                $fechaHoraTimbre->toDateString() . ' ' . $turno->hora_fin
            );

            // turno nocturno o cruza medianoche
            if ($turno->nocturno || $turno->hora_inicio > $turno->hora_fin) {
                $finTurno->addDay();
            }

            // si el timbre es antes de la hora inicio, corresponde al turno del día anterior
            if ($fechaHoraTimbre->lt($inicioTurno)) {
                $inicioTurno->subDay();
                $finTurno->subDay();
            }

            // validar si el timbre pertenece al turno
            if ($fechaHoraTimbre->between($inicioTurno, $finTurno)) {
                return [
                    'turno'        => $turno,
                    'inicioTurno'  => $inicioTurno,
                    'finTurno'     => $finTurno,
                    'fechaTrabajo' => $inicioTurno->toDateString(), // 🔑
                ];
            }
        }

        return null;
    }

    function calcularHoras()
    {

        $turnos = TdEmpleadosTurnos::query()
        ->join('tm_personas as e','e.id','=','td_empleados_turnos.persona_id')
        ->join('tm_turnos_horarios as t','t.id','=','td_empleados_turnos.turno_id')
        ->join('tm_horarios as h','h.id','=','t.horario_id')
        ->selectRaw('t.id,t.sup_25_porcentaje,t.sup_50_porcentaje,t.dias_extra,h.entrada,h.salida,nocturno,h.ini_descanso, h.fin_descanso,td_empleados_turnos.fecha_inicio,td_empleados_turnos.fecha_fin,right(e.nui,9) as nui,e.nombres,e.apellidos')
        ->where('td_empleados_turnos.fecha_inicio','<=',$this->filters['endDate'])
        ->where('td_empleados_turnos.fecha_fin','>=',$this->filters['startDate'])
        ->get();

        $turnosIndexados = $turnos->groupBy('nui');

        foreach ( $this->tblrecords as $fila => $record){

            $codigo  = $record['codigo'];
            $personaId  = $record['personaId'];
            $turnosEmpleado = $turnosIndexados[$codigo] ?? collect();

            if($record['timbre1']!='' && $record['timbre4']!=''){

                $entrada = $record['timbre1'];
                $salida  = $record['timbre4'];
                $fecha   = $record['fecha'];

                $turno = $turnosEmpleado->firstWhere('id', $record['turnoId']);
                $horas = $this->calcularHorasBloque($entrada,$salida,$turno,$fecha);
                $valorHora = $record['sueldo'] / 240;

                $monto25 = $valorHora * 1.25 * $horas['extra25'];
                $monto50 = $valorHora * 1.50 * $horas['extra50'];
                $monto100 = $valorHora * 2.00 * $horas['extra100'];

                $this->tblextras[]=[
                    'linea'  => $fila+1,
                    'personaId' => $record['personaId'],
                    'codigo' => $record['codigo'],
                    'nombre' => $record['nombre'],
                    'depart' => $record['depart'],
                    'cargo'  => $record['cargo'],
                    'sueldo' => $record['sueldo'],
                    'fecha' => $record['fecha'],
                    'normales' => $horas['normales'],
                    'he25' => $horas['extra25'],
                    'monto25' => $monto25,
                    'he50' => $horas['extra50'],
                    'monto50' => $monto50,
                    'he100' => $horas['extra100'],
                    'monto100' => $monto100,
                    'total' => $monto25+$monto50+$monto100,
                ];
            }

        }

        $this->filters['tab'] = 'extras';

    }

    function calcularHorasBloque($timbreEntrada, $timbreSalida, $turno, $fechaTrabajo){

        $marcaEntrada = Carbon::parse($timbreEntrada);
        $marcaSalida  = Carbon::parse($timbreSalida);
        $fecha = Carbon::createFromFormat('d/m/Y', trim($fechaTrabajo))->format('Y-m-d');

        $horaEntrada = Carbon::createFromFormat('H:i:s', trim($turno['entrada']))->format('H:i:s');
                
        $inicioTurno = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $fecha . ' ' . $horaEntrada
        );

        if (
            $marcaEntrada->lt($inicioTurno) &&
            !($turno['nocturno'] ?? false)
        ) {
            // llegó antes del turno → ajustar a hora oficial
            $marcaEntrada = $inicioTurno->copy();
        }
    
        $horaSalida = Carbon::createFromFormat('H:i:s', trim($turno['salida']))->format('H:i:s');

        $finTurno = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $fecha . ' ' . $horaSalida
        );

       /*// Jornada teórica
        $inicioTurno = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $fechaTrabajo . ' ' . $turno['entrada']
        );

        $finTurno = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $fechaTrabajo . ' ' . $turno['salida']
        );*/

        // Turno nocturno
        if ($turno['nocturno'] || $turno['entrada'] > $turno['salida']) {
            $finTurno->addDay();
        }

        // 🔹 determinar tipo de día
        $tipoDia = $this->tipoDia($fechaTrabajo, $this->feriados);

        // Día de la semana
        
        $diaSemana = strtolower($marcaEntrada->locale('es')->dayName);

        // Días 100%
        $diasextras =  str_replace(['[', ']', '"', ' '], '', $turno['dias_extra']);
        $dias100 = collect(explode(',', strtolower($diasextras ?? '')));
        
        $horas = [
            'normales' => 0,
            'extra25'  => 0,
            'extra50'  => 0,
            'extra100' => 0,
        ];

        // 🔹 HORAS NORMALES
        $inicioNormal = $marcaEntrada->copy()->max($inicioTurno);
        $finNormal    = $marcaSalida->copy()->min($finTurno);

        if ($inicioNormal->lt($finNormal)) {
            //$horas['normales'] = intdiv($marcaEntrada->diffInMinutes($marcaSalida),60); //intdiv($inicioNormal->diffInMinutes($finNormal),60);
            $minutos = $marcaEntrada->diffInMinutes($marcaSalida);
            $horas['normales'] = $minutos / 60;
        }

        // 🔹 TODO ES 100%
        if ($dias100->contains($diaSemana)) {
            $horas['extra100'] = intdiv($inicioNormal->diffInMinutes($finNormal),60);//intdiv($marcaEntrada->diffInMinutes($marcaSalida),60); //$marcaEntrada->diffInMinutes($marcaSalida) / 60;
            //return $horas;
        }

        if ($tipoDia === 'FERIADO') {
            $horas['extra100'] = intdiv($inicioNormal->diffInMinutes($finNormal),60);//intdiv($marcaEntrada->diffInMinutes($marcaSalida),60); //$marcaEntrada->diffInMinutes($marcaSalida) / 60;
        }

        // 🔹 DESPUÉS DEL TURNO
        if ($marcaSalida->gt($finTurno)) {

            $inicioExtra = $marcaEntrada->max($finTurno);
            $finExtra    = $marcaSalida;

            // Punto de cambio a nocturno
            $inicioNocturno = $finTurno->copy()->setTime(19, 0, 0);



            /*// TRAMO DIURNO EXTRA (50%)
            if ($inicioExtra->lt($inicioNocturno)) {

                $finDiurno = $finExtra->lt($inicioNocturno) ? $finExtra : $inicioNocturno;
                $minutos50 = $inicioExtra->diffInMinutes($finDiurno);

                if ($minutos50 >= 30) {
                    $horas['extra50'] += ceil($minutos50 / 60);
                }
            }*/
            $horasExtras = max($horas['normales'] - 8, 0);
            if ($horasExtras > 0) {
                $horas['extra50'] += $horasExtras;//min($horasExtras, 4);
            }

            // TRAMO NOCTURNO (25%)
            if ($finExtra->gt($inicioNocturno)) {

                $inicioNoc = $inicioExtra->gt($inicioNocturno) ? $inicioExtra : $inicioNocturno;
                $minutos25 = $inicioNoc->diffInMinutes($finExtra);

                if ($minutos25 >= 30) {
                    $horas['extra25'] +=  min($minutos25 / 60, 4); 
                }
            }
        }

        return $horas;

    }
    
    function tipoDia($fecha, $feriados) {

        $fecha = Carbon::createFromFormat('d/m/Y', trim($fecha))->format('Y-m-d');

        if (in_array($fecha, $feriados)) {
            return 'FERIADO';
        }

        $dia = Carbon::parse($fecha)->dayOfWeek; 
        // 0=domingo

        if ($dia == 0) return 'DOMINGO';
        if ($dia == 6) return 'SABADO';

        return 'LABORAL';
    }

    function grabaTimbre(){

        $timbre = TdTimbres::create([
            'codigo'     => substr($this->record['codigo'], -9),
            'fecha_hora' => Carbon::parse(
                $this->record['fecha'].' '.$this->record['hora']
            ),
            'fecha'      => $this->record['fecha'],
            'hora'       => $this->record['hora'],
            'funcion'    => $this->record['funcion'],
            'estado'     => 'A',
        ]);

        $this->dispatch('hide-form');  
        $this->dispatch('msg-grabar');
        $this->marcaciones();

    }

    public function createData()
    {
        $this ->validate([
            'filters.periodoRolId' => 'required',
        ]);
    
        if (empty($this->tblextras) || !is_array($this->tblextras)) {
            return;
        }

        $usuario = auth()->user()->name;
        $now = now();

        $detalle = collect($this->tblextras)
        ->filter(function ($extras) {
            return ($extras['total'] ?? 0) > 0;
        })
        ->map(function ($extras) use ($usuario, $now) {
            return [
                'periodorol_id' =>$this->filters['periodoRolId'],
                'persona_id' => $extras['personaId'],
                'fecha'      => Carbon::createFromFormat('d/m/Y', $extras['fecha'])->format('Y-m-d'),
                'horas'      => $extras['normales'] ?? 0,
                'extra25'    => $extras['he25'] ?? 0,
                'monto25'    => $extras['monto25'] ?? 0,
                'extra50'    => $extras['he50'] ?? 0,
                'monto50'    => $extras['monto50'] ?? 0,
                'extra100'   => $extras['he100'] ?? 0,
                'monto100'   => $extras['monto100'] ?? 0,
                'total'      => $extras['total'],
                'usuario'    => $usuario,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })
        ->values()
        ->toArray();

        DB::transaction(function () use ($detalle) {
            TdHorasExtras::upsert(
                $detalle,
                ['persona_id', 'fecha'], // clave compuesta
                [
                    'periodorol_id',
                    'horas',
                    'extra25',
                    'monto25',
                    'extra50',
                    'monto50',
                    'extra100',
                    'monto100',
                    'total',
                    'usuario',
                    'updated_at',
                ]
            );
        });

        // Limpia o refresca datos en Livewire
        $this->reset('tblextras');

        // Evento para UI
        $this->dispatch('msg-grabar');
    }

}
