<?php

namespace App\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TmTiposrol;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Vcperiodosrol extends Component
{   
    use WithPagination;
    public $showEditModal = false;
    public $selectId, $selectValue;
    public $record;
    public $meses = [ 
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'];
    
    public $tiempo = [
        'Q' => 'Quincenal',
        'M' => 'Mensual'];
    
    public $filters = [
        'periodo' => '',
        'mes' => '',
        'proceso' => '',
        'estado' => '',
        'procesado' => '',
        'aprobado' => '',
        'cerrado' => '',

    ];

    //protected $listeners = ['saveData'];

    public function render()
    {

        $tbltiporols = TmTiposrol::all();
        $periodos    = DB::Select("
            Select year(fechafin) as periodo from tm_periodosrols
            Where remuneracion = 'M'
            Group by year(fechafin)");

        $this->estado();

        $tblrecords  = TmPeriodosrol::query()
        ->when($this->filters['periodo'],function($query){
            return $query->whereRaw('year(fechafin) = '.$this->filters['periodo']);
        })
        ->when($this->filters['mes'],function($query){
            return $query->where('mes',$this->filters['mes']);
        })
        ->when($this->filters['proceso'],function($query){
            return $query->where('remuneracion',$this->filters['proceso']);
        })
        ->when($this->filters['procesado'],function($query){
            return $query->where('procesado',$this->filters['procesado']);
        })
        ->when($this->filters['aprobado'],function($query){
            return $query->where('aprobado',$this->filters['aprobado']);
        })
        ->when($this->filters['cerrado'],function($query){
            return $query->where('cerrado',$this->filters['cerrado']);
        })

        ->orderByRaw('tiporol_id, mes')
        ->paginate(10);


        return view('livewire.vc-periodosrol',[
            'tblrecords' => $tblrecords,
            'tbltiporols' => $tbltiporols,
            'periodos' => $periodos,
        ]);

    }

    public function estado(){

        switch ($this->filters['estado']){
            case 'G':
                $this->filters['procesado'] = 1;
                $this->filters['aprobado'] = '';
                $this->filters['cerrado'] = '';
                break;
            case 'A':
                $this->filters['aprobado'] = 1;
                $this->filters['procesado'] = '';
                $this->filters['cerrado'] = '';
                break;
            case 'C':
                $this->filters['cerrado'] = 1;
                $this->filters['aprobado'] = '';
                $this->filters['procesado'] = '';
                break;
            default:
                $this->filters['cerrado'] = '';
                $this->filters['aprobado'] = '';
                $this->filters['procesado'] = '';
        }

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['tiporol_id']= 0;
        $this->record['mes']= 0;
        $this->record['tiempo']= "";
        $this->record['fechaini']= ""; 
        $this->record['fechafin']= "";       
        $this->dispatch('show-form');

    }
    public function edit(TmPeriodosrol $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatch('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmPeriodosrol::find($id);
        $this->selectValue = $record->tiporol['descripcion'];

        $this->dispatch('show-delete');

    }

    public function createData(){
        
        $this->dispatch('hide-form');
        $this->dispatch('get-date');
        
    }    

    #[On('saveData')]
    public function saveData($fechaini, $fechafin)
    {
        $this->record['fechaini'] = $fechaini;
        $this->record['fechafin'] = $fechafin;

        $this->validate([
            'record.tiporol_id'   => 'required|integer|min:1',
            'record.mes'          => 'required|integer|min:1|max:12',
            'record.remuneracion' => 'required|in:Q,M',
            'record.fechaini'     => 'required|date',
            'record.fechafin'     => 'required|date',
        ]);

        TmPeriodosrol::updateOrCreate(
            [
                'tiporol_id'   => $this->record['tiporol_id'],
                'mes'          => $this->record['mes'],
                'remuneracion' => trim($this->record['remuneracion']),
            ],
            [
                'fechaini' => $this->record['fechaini'],
                'fechafin' => $this->record['fechafin'],
                'procesado'=> false,
                'aprobado' => false,
                'cerrado'  => false,
                'estado' => 'A',
                'usuario'  => auth()->user()->name,
            ]
        );

        $this->reset('record');
        $this->dispatch('msg-grabar');
    }


    public function updateData(){

        $this ->validate([
            'record.tiporol_id' => 'required',
            'record.mes' => 'required',
            'record.remuneracion' => 'required',
            'record.fechaini' => 'required',
            'record.fechafin' => 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmPeriodosrol::find($this->selectId);
            $record->update([
                'tiporol_id' => $this -> record['tiporol_id'],
                'mes' => $this -> record['mes'],
                'remuneracion' => $this -> record['remuneracion'],
                'fechaini' => date('Y-m-d H:i:s', strtotime($this -> record['fechaini'])),
                'fechafin' => date('Y-m-d H:i:s', strtotime($this -> record['fechafin'])),
            ]);
            
        }
      
        $this->dispatch('hide-form', ['message'=> 'added successfully!']);
        $this->dispatch('msg-actualizar');
        
    }

    public function deleteData()
    {
        $record = TmPeriodosrol::find($this->selectId);
        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatch('hide-delete');
    }

    public function resetFilter(){

        $this->filters['periodo'] = '';
        $this->filters['mes'] = '';
        $this->filters['proceso'] = '';
        $this->filters['estado'] = '';
        $this->filters['procesado'] = '';
        $this->filters['aprobado'] = '';
        $this->filters['cerrado'] = '';

    }

}
