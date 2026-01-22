<?php

namespace App\Livewire;
use App\Models\tmProductoTerminado;

use Livewire\Component;
use Livewire\WithPagination;

class VcProduccionPT extends Component
{
    use WithPagination;
    public $showEditModal = false;
    public $selectID;
    public $editControl='';

    public $arrubica = [
        'U001'=>'Extractora - Quevedo',
        'U002'=>'Refineria - Quevedo',
        'U003'=>'Palmisteria - Quevedo',
        'U004'=>'Procepalma- Santo Domingo',
        'U005'=>'Oleana - Esmeraldas',
        'U006'=>'Oliojoya - Esmeralda',
        'U007'=>'Extractora - Oriente',
    ];

    public $record= [
        'fecha'=>'',
        'tanque'=>'',
        "producto"=>'P001',
        "toneladas"=> 0,
        "ubicacion"=> 'U001',
        "acidez"=> 0,
        "humedad"=> 0,
        "impuereza"=> 0,
        "color"=> '',
        "peroxido"=> '',
        "referencia"=> ''
    ];

    public function render()
    {
        $tblrecord = tmProductoTerminado::paginate(12);
        return view('livewire.vc-produccion-p-t',[
            'tblrecord'=> $tblrecord,
        ]);
    }

 public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }	

    public function addData(){
        
        $this->editControl = '';
        $this->showEditModal = false;
        $fecha = date('Y-m-d');
            $this->record =[
            'fecha'=> $fecha,
            'tanque'=>'',
            "producto"=>'P001',
            "tonelada"=> 0,
            "ubicacion"=> 'U001',
            "acidez"=> 0,
            "humedad"=> 0,
            "impureza"=> 0,
            "color"=> '',
            "peroxido"=> '',
            "referencia"=> '',
        ];
        $this->dispatch('show-form');
    }

    public function createData()
    {
        $this ->validate([
            'record.fecha' => 'required',
            'record.tanque' => 'required',
            'record.producto' => 'required',
            'record.tonelada' => 'required',
            'record.ubicacion' => 'required',
            'record.acidez' => 'required',
            'record.humedad' => 'required',
            'record.impureza' => 'required',
            'record.color' => 'required',
            'record.peroxido' => 'required',
        ]);

        tmProductoTerminado::create([
            'fecha' => $this->record['fecha'],
            'tanque' => $this->record['tanque'],
            'producto' => $this->record['producto'],
            'tonelada' => $this->record['tonelada'],
            'ubicacion' => $this->record['ubicacion'],
            'acidez' => $this->record['acidez'],
            'humedad' => $this->record['humedad'],
            'impureza' => $this->record['impureza'],
            'color' => $this->record['color'],
            'peroxido' => $this->record['peroxido'],
            'referencia' => $this->record['tanque'].'-'.$this->arrubica[$this->record['ubicacion']],
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatch('hide-form');

        $this->dispatch('msg-grabar');
    }

    public function edit($id){
        
        $this->editControl = 'disabled';
        $this->selectID = $id;
        $this->showEditModal = true;
        $temp = tmProductoTerminado::find($id);

        $this->record['fecha'] = date('Y-m-d',strtotime($temp->fecha));
        $this->record['tanque'] = $temp->tanque;
        $this->record['producto'] = $temp->producto;
        $this->record['tonelada'] = $temp->tonelada;
        $this->record['ubicacion'] = $temp->ubicacion;
        $this->record['acidez'] = $temp->acidez;
        $this->record['humedad'] = $temp->humedad;
        $this->record['impureza'] = $temp->impureza;
        $this->record['color'] = $temp->color;
        $this->record['peroxido'] = $temp->peroxido;

        $this->dispatch('show-form');
    }

    public function updateData(){
        
        $this ->validate([
            'record.fecha' => 'required',
            'record.tanque' => 'required',
            'record.producto' => 'required',
            'record.tonelada' => 'required',
            'record.ubicacion' => 'required',
            'record.acidez' => 'required',
            'record.humedad' => 'required',
            'record.impureza' => 'required',
            'record.color' => 'required',
            'record.peroxido' => 'required',
        ]);

        $temp = tmProductoTerminado::find($this->selectID);
        $temp->update([
            'tanque' => $this->record['tanque'],
            'producto' => $this->record['producto'],
            'tonelada' => $this->record['tonelada'],
            'ubicacion' => $this->record['ubicacion'],
            'acidez' => $this->record['acidez'],
            'humedad' => $this->record['humedad'],
            'impureza' => $this->record['impureza'],
            'color' => $this->record['color'],
            'peroxido' => $this->record['peroxido'],
            'referencia' => $this->record['tanque'].'-'.$this->arrubica[$this->record['ubicacion']],
        ]);
        $this->dispatch('hide-form');
        $this->dispatch('msg-grabar');
    }

    public function delete($id){
        $this->selectID = $id;
        $this->dispatch('show-delete');
    }

    public function deleteData(){
        tmProductoTerminado::where('id',$this->selectID)->delete();
        $this->dispatch('hide-delete');
    }

}
