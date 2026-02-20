<?php

namespace App\Livewire;

use App\Models\TmPersonas;
use App\Models\TmArea;
use App\Models\TmContratos;
use App\Models\TdSolicitudVacaciones;
use App\Models\TdPeriodoVacaciones;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VcVacacionesHistorial extends Component
{
    public $personaId, $dias;

    public $filters=[
        'periodo' => '',
        'area' => '',
        'departamento' => '',
        'tab' => 'resumen'
    ];

    public function mount($id)
    {
        $this->personaId = $id;
    }
    
    public function render()
    {
        $personas = TmContratos::query()
        ->join('tm_personas as p','p.id','=','tm_contratos.persona_id')
        ->join('tm_areas as a','a.id','=','tm_contratos.area_id')
        ->join('tm_areas as a2','a2.id','=','tm_contratos.departamento_id')
        ->join('tm_cargocias as c','c.id','=','tm_contratos.cargo_id')
        ->where('p.id',$this->personaId)
        ->select('p.*','tm_contratos.fecha_ingreso','a.descripcion as area','a2.descripcion as departamento',
        'c.descripcion as cargo')
        ->orderBy('apellidos')
        ->first();
        
        $tblrecords = TdSolicitudVacaciones::query()
        ->join('tm_personas as p','p.id','=','td_solicitud_vacaciones.persona_id')
        ->join('tm_contratos as c','c.persona_id','=','p.id')
        ->join('tm_cargocias as cc','c.cargo_id','=','cc.id')
        ->select('p.nombres','p.apellidos','cc.descripcion as cargo','td_solicitud_vacaciones.*')
        ->where('p.id',$this->personaId)
        ->paginate(12);

        $vacaciones = $this->diasVacaciones();
        $periodos = $this->detalle();

        return view('livewire.vc-vacaciones-historial',[
            'tblrecords' => $tblrecords,
            'personas' =>  $personas,
            'vacaciones' => $vacaciones,
            'periodos' => $periodos,
        ]);
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

        ->select(
            'p.id',
            'p.nombres',
            'p.apellidos',
            'a.descripcion as area',
            'd.descripcion as departamento',
            DB::raw('COALESCE(pv.disponibles, 0) AS disponibles'),
            DB::raw('COALESCE(sv.aprobadas, 0) AS aprobadas'),
            DB::raw('COALESCE(sv.solicitadas, 0) AS solicitadas')
        )
        ->where('p.id',$this->personaId)
        ->orderBy('p.apellidos')
        ->first();
        
        $this->dias = $vacaciones->disponibles-($vacaciones->solicitadas);

        return $vacaciones;

    }

    public function detalle(){

        $periodos = TdPeriodoVacaciones::with([
            'movimientos' => function($q){
                $q->orderBy('created_at');
            },
            'movimientos.solicitud'
        ])
        ->where('persona_id', $this->personaId)
        ->orderBy('periodo')
        ->get();

        return $periodos;
    }
}
