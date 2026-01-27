<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TdPermisos;
use App\Models\TmContratos;
use App\Models\TmArea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class VcPermisos extends Component
{   
    use WithPagination;

    public $selectValue, $showEditModal, $record, $periodo, $tblperiodos;

    public $filters=[
        'departamento' => '',
        'periodo' => '',
        'estado' => '',
        'buscar' => '',
    ];

    public $estado=[
        'S' => ['estado' => 'Solicitado','color' => 'badge-soft-warning'],
        'A' => ['estado' => 'Aprobado','color' => 'badge-soft-success'],
        'C' => ['estado' => 'Cerrada','color' => 'badge-soft-primary'],
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

    }

    public function render()
    {   
        
        $departs  = TmArea::query()
        ->whereRaw('area_id > 0')
        ->get();

        $personas = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('tm_contratos.departamento_id', $this->filters['departamento']))
        ->orderBy('apellidos')
        ->select('p.*')
        ->get();

        $tblrecords = TdPermisos::query()
        ->join('tm_personas as p','p.id','=','td_permisos.persona_id')
        ->join('tm_contratos as c','c.persona_id','=','p.id')
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('c.departamento_id', $this->filters['departamento']))
        ->when(filled($this->filters['periodo']), fn($q) =>
            $q->whereRaw('year(td_permisos.fecha) ='.$this->filters['periodo']))
        ->when(filled($this->filters['estado']), fn($q) =>
            $q->where('td_permisos.estado', $this->filters['estado']))
        ->when($this->filters['buscar'],function($query){
            return $query->where('nombres','like','%'.$this->filters['buscar'].'%')
                        ->orWhere('apellidos','like','%'.$this->filters['buscar'].'%');
        })
        ->select('td_permisos.*')
        ->paginate(12);  

        return view('livewire.vc-permisos',[
            'tblrecords' => $tblrecords,
            'personas' => $personas,
            'estado' => $this->estado,
            'departs' => $departs,
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->record['personaId']= 0;
        $this->record['fechadesde']= '';
        $this->record['fechahasta']= ''; 
        $this->record['horadesde']= '08:00';
        $this->record['horahasta']= '17:00'; 
        $this->record['referencia']= ''; 
        $this->record['comentario']= ''; 
        $this->record['remuneracion']= 'N';
        $this->record['estado']= 'S';

        $this->dispatch('show-form');
        
    }

    public function edit(TdPermisos $tblrecords ){
        
        $this->showEditModal = true;
        $record  = $tblrecords->toArray();

        $this->record['personaId']  = $record['persona_id'];
        $this->record['fechadesde'] = date('Y-m-d',strtotime($record['fecha_empieza']));
        $this->record['fechahasta'] = date('Y-m-d',strtotime($record['fecha_termina']));
        $this->record['horadesde']  = date('H:i:s',strtotime($record['fecha_empieza']));
        $this->record['horahasta']  = date('H:i:s',strtotime($record['fecha_termina'])); 
        $this->record['referencia'] = $record['referencia'];; 
        $this->record['comentario'] = $record['observacion'];; 
        $this->record['remuneracion'] = $record['remuneracion'];;
        $this->record['estado'] = $record['estado'];;
       
        $this->selectId = $record['id'];
        $this->dispatch('show-form');

    }

    public function createData(){
        
        $this ->validate([
            'record.fecha' => 'required',
            'record.personaId' => 'required',
            'record.referencia' => 'required',
            'record.fechadesde' => 'required',
            'record.fechahasta' => 'required',
            'record.horadesde' => 'required',
            'record.horahasta' => 'required',
            'record.remuneracion' => 'required',
        ]);

        $startDate = date('d-m-Y',strtotime($this->record['fechadesde'])).' '.$this->record['horadesde'];
        $endDate = date('d-m-Y',strtotime($this->record['fechahasta'])).' '.$this->record['horahasta'];
        $inicio = Carbon::createFromFormat('d-m-Y H:i', $startDate);
        $fin    = Carbon::createFromFormat('d-m-Y H:i', $endDate);

        // Validación básica
        if ($fin->lessThanOrEqualTo($inicio)) {
            throw new \Exception('La fecha/hora final debe ser mayor a la inicial');
        }

        $totalHoras = $inicio->diffInMinutes($fin) / 60;

        // Total días (laborales o calendario)
        $totalDias = $this->calculaTiempo($inicio,$fin);

        if ($totalHoras < 8) {
            $tiempo = $totalHoras;
            $tipoPermiso = 'horas';
        } else {
            $tiempo = $totalDias;
            $tipoPermiso = 'dias';
        }

        TdPermisos::Create([
            'persona_id' => $this->record['personaId'],
            'fecha' => $this->record['fecha'],
            'referencia' => $this->record['referencia'],
            'remuneracion' => $this->record['remuneracion'],
            'fecha_empieza' => $this->record['fechadesde'].' '.$this->record['horadesde'],
            'fecha_termina' => $this->record['fechahasta'].' '.$this->record['horahasta'],
            'observacion' => $this -> record['comentario'],
            'tiempo' => $tiempo.' '.$tipoPermiso,
            'estado' => 'S',
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
}
