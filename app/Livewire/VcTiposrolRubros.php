<?php

namespace App\Livewire;
use App\Models\TmTiposrol;
use App\Models\TmRubrosrol;
use App\Models\TdTiporolRubros;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class VcTiposrolRubros extends Component
{
    
    use WithPagination;
    public $selectId=1, $nomtiporol="", $showEditModal=false;
    public $rubroRolId, $rubroTipo, $rubroPago, $tblrubros, $tiporolRubroId;
    public $arrayTipo = [
        'P' => 'Percepción',
        'D' => 'Deducción'
    ];
    public $arrayPago = [
        'Q' => 'Quincenal',
        'M' => 'Mensual'
    ];

    public function mount(){
        $this->selectId = 1;
        $this->loadData();
    }

    public function render()
    {
        $tbltiposrols = TmTiposrol::all();
        $tblrecords   = TdTiporolRubros::where('tiposrol_id',$this->selectId)->paginate(15);

        return view('livewire.vc-tiposrol-rubros',[
            'tbltiposrols' => $tbltiposrols,
            'tblrecords'   => $tblrecords,
            'tblrubros'    => $this->tblrubros
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function loadData(){

        $data = TmTiposrol::find($this->selectId);
        $this->nomtiporol = $data['descripcion'];

        $this->tblrubros = TmRubrosrol::query()
        ->leftJoin('td_tiporol_rubros as t', function ($join) {
            $join->on('tm_rubrosrols.id', '=', 't.rubrosrol_id')
                ->where('t.tiposrol_id', $this->selectId);
        })
        ->select('tm_rubrosrols.*')
        ->where('tm_rubrosrols.estado', 'A')
        ->where(function ($query) {
            $query->whereNull('t.rubrosrol_id');
        })
        ->get();
    }



    public function add(){
        
        $this->showEditModal = false;
        
        $this->rubroRolId= '';
        $this->rubroTipo= '';
        $this->rubroPago= '';    
        $this->dispatch('show-form');
        
    }

    public function edit($id){

        $registro = TdTiporolRubros::find($id);
        
        $this->tiporolRubroId = $registro->id; 
        $this->rubroRolId   = $registro->rubrosrol_id; 
        $this->rubroTipo = $registro->tipo;
        $this->rubroPago = $registro->remuneracion;
        $this->showEditModal = true;
        
        $this->tblrubros = TmRubrosrol::query()
        ->where('tm_rubrosrols.estado', 'A')
        ->get();
       
        $this->dispatch('show-form');

    }

    public function createData(){
        
        $this ->validate([
            'rubroRolId'   => 'required',
            'rubroTipo' => 'required',
            'rubroPago' => 'required',
        ]);

        TdTiporolRubros::Create([
            'tiposrol_id' => $this -> selectId,
            'rubrosrol_id' => $this -> rubroRolId,
            'tipo' => $this -> rubroTipo,
            'remuneracion' => $this -> rubroPago,
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatch('hide-form', ['message'=> 'added successfully!']);
        $this->dispatch('msg-grabar');  
        $this->rubroRolId = '';
        
    }

    public function updateData(){

        $this ->validate([
            'rubroRolId'   => 'required',
            'rubroTipo' => 'required',
            'rubroPago' => 'required',
        ]);        
        

        $record = TdTiporolRubros::find($this->tiporolRubroId);
        $record->update([
            'tipo' => $this -> rubroTipo,
            'remuneracion' => $this -> rubroPago,
        ]);
            
        $this->dispatch('hide-form');
        $this->dispatch('msg-actualizar');
        $this->rubroRolId = '';
        
    }




}
