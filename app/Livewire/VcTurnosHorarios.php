<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TmHorarios;
use App\Models\TmArea;
use App\Models\TmTurnosHorarios;

class VcTurnosHorarios extends Component
{
    public $showEditModal, $selectValue, $record;

    use WithPagination;
    
    public $dias_extra = [];

    protected $casts = [
        'dias_extra' => 'array',
    ];
    
    public $diasSemana = [
        'lunes' => 'Lunes',
        'martes' => 'Martes',
        'miercoles' => 'Miércoles',
        'jueves' => 'Jueves',
        'viernes' => 'Viernes',
        'sábado' => 'Sábado',
        'domingo' => 'Domingo',
    ];

    public function render()
    {
        $horarios = TmHorarios::all();

        $areas = TmArea::query()
        ->where('area_id','>',0)
        ->get();

        $tblrecords = TmTurnosHorarios::query()
        ->paginate(12);

        return view('livewire.vc-turnos-horarios',[
            'horarios' => $horarios,
            'areas' => $areas,
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['descripcion']= '';
        $this->record['tipo_personal']= '';
        $this->record['horario_id']= 0;

        $this->record['sup_25_aplica']= false;
        $this->record['sup_25_porcentaje']= 0;
        $this->record['sup_50_aplica']= false;
        $this->record['sup_50_porcentaje']= 0;
        $this->record['extra_aplica']= false;
        $this->record['extra_porcentaje']= 100;
        $this->record['dias_recargo']= '';       
        $this->record['estado']= 'A'; 

        $this->dias_extra = [];

        $this->dispatch('show-form');

    }

    public function edit($data){
        
        $this->showEditModal = true;
        $this->record  = $data;
        $this->record['sup_25_aplica'] = (bool) $this->record['sup_25_aplica'];
        $this->record['sup_50_aplica'] = (bool) $this->record['sup_50_aplica'];

        $this->dias_extra = json_decode($this->record['dias_extra'], true);  
       
        $this->selectId = $this -> record['id'];
        
        $this->dispatch('show-form');

    }

    public function createData()
    {
        $this->validate([
            'record.descripcion' => 'required',
            'record.tipo_personal' => 'required',
            'record.horario_id' => 'required',
        ]);

        TmTurnosHorarios::create([
            'descripcion' => $this->record['descripcion'],
            'area_id' => $this->record['tipo_personal'],
            'horario_id' => $this->record['horario_id'],
            'sup_25_aplica' => $this->record['sup_25_aplica'],
            'sup_25_porcentaje' => $this->record['sup_25_porcentaje'],
            'sup_50_aplica' => $this->record['sup_50_aplica'],
            'sup_50_porcentaje' => $this->record['sup_50_porcentaje'],
            'extra_aplica' => $this->record['extra_aplica'],
            'extra_porcentaje' => $this->record['extra_porcentaje'],
            'dias_extra' => json_encode($this->dias_extra),
            'estado' => 'A',
        ]);

        $this->dispatch('hide-form');
        $this->dispatch('msg-grabar');
    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmTurnosHorarios::find($this->selectId);
        $this->selectValue = $record['descripcion'];

        $this->dispatch('show-delete');

    }

    public function deleteData(){

        $record = TmTurnosHorarios::find($this->selectId);
        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatch('hide-delete');
        
    }


}
