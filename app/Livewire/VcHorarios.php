<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TmDepartament;
use App\Models\TmHorarios;

class VcHorarios extends Component
{   
    public $record;
    public $showEditModal=false, $selectValue;

    use WithPagination;

    public function render()
    {   

        $tblrecords = TmHorarios::query()
        ->paginate(10); 

        return view('livewire.vc-horarios',[
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
        $this->record['entrada']= '00:00:00';
        $this->record['salida']= '00:00:00';
        $this->record['ini_entrada']= '00:00:00';
        $this->record['fin_entrada']= '00:00:00';
        $this->record['ini_salida']= '00:00:00';
        $this->record['fin_salida']= '00:00:00';
        $this->record['nocturno']= false;
        $this->record['jornada']= 0;
        $this->record['tolerancia']= 0;
        $this->record['ini_descanso']= '00:00:00';
        $this->record['fin_descanso']= '00:00:00';
        $this->record['descanso']= 0;
        $this->record['estado']= 'A'; 

        $this->dispatch('show-form');

    }

    public function edit($data){
        
        $this->showEditModal = true;
        $this->record  = $data;
       
        $this->selectId = $this -> record['id'];
        $this->dispatch('show-form');

    }

    public function createData(){
        
        $this ->validate([
            'record.descripcion' => 'required',
            'record.entrada' => 'required',
            'record.salida' => 'required',
            'record.ini_entrada' => 'required',
            'record.fin_entrada' => 'required',
            'record.ini_salida' => 'required',
            'record.fin_salida' => 'required',
            'record.nocturno' => 'required',
            'record.jornada' => 'required',
            'record.tolerancia' => 'required'
        ]);

        TmHorarios::Create([
            'descripcion' => $this -> record['descripcion'],
            'entrada' => $this -> record['entrada'],
            'salida' => $this -> record['salida'],
            'ini_entrada' => $this -> record['ini_entrada'],
            'fin_entrada' => $this -> record['fin_entrada'],
            'ini_salida' => $this -> record['ini_salida'],
            'fin_salida' => $this -> record['fin_salida'],
            'nocturno' => $this -> record['nocturno'],
            'jornada' => $this -> record['jornada'],
            'tolerancia' => $this -> record['tolerancia'],
            'descanso' => $this -> record['descanso'],
            'ini_descanso' => $this -> record['ini_descanso'],
            'fin_descanso' => $this -> record['fin_descanso'],
            'estado' => 'A',
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatch('hide-form', ['message'=> 'added successfully!']);  
        $this->dispatch('msg-grabar');
    }


    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmHorarios::find($this->selectId);
        $this->selectValue = $record['descripcion'];

        $this->dispatch('show-delete');

    }

    public function deleteData(){

        $record = TmHorarios::find($this->selectId);
        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatch('hide-delete');
    }



}
