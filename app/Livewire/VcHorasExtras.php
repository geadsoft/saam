<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TmArea;
use App\Models\TdHorasExtras;
use Livewire\WithPagination;


class VcHorasExtras extends Component
{
    use WithPagination;

    public $filters = [
        'buscar' => '',
        'startDate' => '',
        'endDate' => '',
        'departamento' => '',
    ]; 

    public function render()
    {
        $departs  = TmArea::query()
        ->whereRaw('area_id > 0')
        ->get();

        $tblrecords = TdHorasExtras::query()
        ->join('tm_personas as p','p.id','=','td_horas_extras.persona_id')
        ->join('tm_contratos as c','c.persona_id','=','p.id')
        ->select('td_horas_extras.*','p.apellidos','p.nombres','p.nui','c.sueldo')
        ->when($this->filters['buscar'],function($query){
            return $query->where('nombres','like','%'.$this->filters['buscar'].'%')
                        ->orWhere('apellidos','like','%'.$this->filters['buscar'].'%')
                        ->orWhere('nui','like','%'.$this->filters['buscar'].'%');
        })              
        ->when(filled($this->filters['departamento']), fn($q) =>
            $q->where('c.departamento_id', $this->filters['departamento']))
        ->when($this->filters['startDate'],function($query){
            return $query->where('fecha','>=',$this->filters['startDate']);
        })
        ->when($this->filters['endDate'],function($query){
            return $query->where('fecha','<=',$this->filters['endDate']);
        })
        ->paginate(12);
    
        return view('livewire.vc-horas-extras',[
            'departs' => $departs,
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }
}
