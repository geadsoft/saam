<?php

namespace App\Livewire;
use App\Models\TcNovedades;
use App\Models\TdNovedades;

use Livewire\Component;

class VcGestion extends Component
{
    public $selecId, $asignara = false;
    public $showEditModal = false;
    public $record = [];


    public function render()
    {
        $temp = TcNovedades::query()
        ->where('usuario',auth()->user()->name)
        ->orwhere('asignado',auth()->user()->email)
        ->get();
        
        $tempenv = TdNovedades::query()
        ->join('tc_novedades as c','c.id','=','td_novedades.novedad_id')
        ->where('enviado',auth()->user()->email)
        ->select('c.*','enviado','td_novedades.usuario as userenv')
        ->get();

        return view('livewire.vc-gestion',[
            'temp'=> $temp,
            'tempenv' => $tempenv,
        ]);
    }

    public function addData()
    {
        $this->showEditModal = false;
        $fecha = date('Y-m-d');
        $this->record = [
            'titulo'=>'',
            'usuario'=> auth()->user()->name,
            'asignado'=>'hvillavicencio@quevepalma.com',
            'fecha'=> $fecha,
            'estado'=>'N',
            'descripcion'=>'',
            'prioridad'=>'',
            'tipo' => '',
        ];
        $this->dispatch('show-form');
    }

    public function asignar($id){
        $this->selecId = $id;
        $this->asignara = true;
        $this->showEditModal = true;
        $temp = tcNovedades::find($id);
        $this->record = [
            'titulo'=> $temp->titulo,
            'usuario'=> $temp->usuario,
            'asignado'=>'',
            'fecha'=> $temp->fecha,
            'estado'=>$temp->estado,
            'fechaini'=>'',
            'fechafin'=>'',
            'descripcion'=>$temp->descripcion,
            'prioridad'=>$temp->prioridad,
            'tipo' => $temp->tipo,
        ];
        $this->dispatch('show-form');
    }

    public function createData()
    {
        $this ->validate([
            'record.titulo' => 'required',
            'record.asignado' => 'required',
            'record.fecha' => 'required',
            'record.descripcion' => 'required',
            'record.tipo' => 'required',
        ]);

        $hora = date('H:i:s');

        tcNovedades::create([
            'fecha' => $this->record['fecha'].' '.$hora,
            'titulo' => $this->record['titulo'],
            'descripcion' => $this->record['descripcion'],
            'usuario' => auth()->user()->name,
            'asignado' => $this->record['asignado'],
            'fechaini'=> null,
            'fechafin' => null,
            'estado' => $this->record['estado'],
            'prioridad' => $this->record['prioridad'],
            'tipo' => $this->record['tipo'],
        ]);

        $this->dispatch('hide-form');

        $this->dispatch('msg-grabar');
    }

    public function updateData(){
        if($this->asignara == true){
            $this->asignarUser();
        }
    }

    public function asignarUser(){
        $temp = tcNovedades::find($this->selecId);
        $temp->update([
            'fechaini'=>$this->record['fechaini'],
            'fechafin'=>$this->record['fechafin'],
        ]);
        
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        tdNovedades::create([
            'novedad_id' => $this->selecId,
            'fecha' => $fecha.' '.$hora,
            'enviado' => $this->record['asignado'],
            'observacion' => $this->record['descripcion'],
        ]);

        $this->dispatch('hide-form');

        $this->dispatch('msg-grabar');

    }
}
