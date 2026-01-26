<?php

namespace App\Livewire;
use App\Models\TmCompania;
use App\Models\TmRubrosrol;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class VcEmpresas extends Component
{
    public $addNew = false, $estado="";
    public $existsrecno = false;
    public $selectId, $periodo;
    public $record;
    public $view;

    public function mount()
    {
        $response = Http::get('http://181.198.111.178/api-erp/api/ctas-resultados');
        $this->tblperiodo = collect($response->object())
        ->sortByDesc('periodo')
        ->values();

        $this->periodo = $this->tblperiodo[0]->periodo;
        
        $tblcia = TmCompania::first();
        $this->selectId = $tblcia->id;

        $this->estado = "";
        if($tblcia){
            $this->estado ='disabled';
        }
        
    }

    public function render()
    {
        $tblrecords = TmCompania::first();
        $tblrubros  = TmRubrosrol::whereRaw('variable1 >1 or importe>0 or regplanilla = 1')->get();

        /*$views = TmCompania::orderBy('id','desc')->first();
        $this->view = $views;*/

        $this->record  = $tblrecords->toArray();
        
        return view('livewire.vc-empresas',[
            'tblrecords' => $tblrecords,
            'tblrubros' => $tblrubros,
        ]);

    }

    public function add(){
        
        $this->addNew = true;     
        $this->dispatch('show-form');

    }

    public function edit(){
        
        $this->addNew = false;       
        $this->estado = "";

    }

    /*public function delete( $id ){
        
        $this->selectId = $id;
        $this->dispatch('show-delete');

    }*/

    public function buscarCuenta(){
        
        $this->dispatch('show-form');

    }

    /*public function view( $id ){
        
        $this->view = TmCompania::find($id)->toArray();

    }*/


    public function createData(){
        
        $this ->validate([
            'record.razonsocial' => 'required',
            'record.nombrecomercial' => 'required',
            'record.ruc' => 'required',
            'record.telefono' => 'required',
            'record.provincia' => 'required',
            'record.ciudad' => 'required',
            'record.canton' => 'required',
            'record.ubicacion' => 'required',
            'record.representante' => 'required',
            'record.identificacion' => 'required',
            'record.website' => 'required',
            'record.email' => 'required',
            'record.salario_basico' => 'required',
            'record.aporte_personal' => 'required',
            'record.rubro_appersonal' => 'required',
            'record.aporte_patronal' => 'required',
            'record.rubro_appatronal' => 'required',
            'record.aporte_secap' => 'required',
            'record.rubro_apsecap' => 'required',
            'record.aporte_iece' => 'required',
            'record.rubro_apiece' => 'required',
            'record.rubro_freserva' => 'required',
            'record.decimo_tercero' => 'required',
            'record.decimo_cuarto' => 'required',
            'record.vacaciones' => 'required',
            'record.elaborado' => 'required',
            'record.revisado' => 'required',
            'record.visto_bueno' => 'required',
        ]);

        TmCompania::Create([
            'razonsocial' => $this -> record['razonsocial'],
            'nombrecomercial' => $this -> record['nombrecomercial'],
            'ruc' => $this -> record['ruc'],
            'telefono' => $this -> record['telefono'],
            'provincia' => $this -> record['provincia'],
            'ciudad' => $this -> record['ciudad'],
            'canton' => $this -> record['canton'],
            'ubicacion' => $this -> record['ubicacion'],
            'representante' => $this -> record['representante'],
            'identificacion' => $this -> record['identificacion'],
            'website' => $this -> record['website'],
            'email' => $this -> record['email'],
            'salario_basico' => $this -> record['salario_basico'],
            'aporte_personal' => $this -> record['aporte_personal'],
            'rubro_appersonal' => $this -> record['rubro_appersonal'],
            'aporte_patronal' => $this -> record['aporte_patronal'],
            'rubro_appatronal' => $this -> record['rubro_appatronal'],
            'aporte_secap' => $this -> record['aporte_secap'],
            'rubro_apsecap' => $this -> record['rubro_apsecap'],
            'aporte_iece' => $this -> record['aporte_iece'],
            'rubro_apiece' => $this -> record['rubro_apiece'],
            'rubro_freserva' => $this -> record['rubro_freserva'],
            'decimo_tercero' => $this -> record['decimo_tercero'],
            'decimo_cuarto' => $this -> record['decimo_cuarto'],
            'extra25' => $this -> record['extra25'],
            'extra50' => $this -> record['extra50'],
            'extra100' => $this -> record['extra100'],
            'vacaciones' => $this -> record['vacaciones'],
            'elaborado' => $this -> record['elaborado'],
            'revisado' => $this -> record['revisado'],
            'visto_bueno' => $this -> record['visto_bueno'],
            'imagen' => "",
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatch('hide-form', ['message'=> 'added successfully!']);  
        
    }

    public function updateData(){

        $this ->validate([
            'record.id' => 'required',
            'record.razonsocial' => 'required',
            'record.nombrecomercial' => 'required',
            'record.ruc' => 'required',
            'record.telefono' => 'required',
            'record.provincia' => 'required',
            'record.ciudad' => 'required',
            'record.canton' => 'required',
            'record.ubicacion' => 'required',
            'record.representante' => 'required',
            'record.identificacion' => 'required',
            'record.website' => 'required',
            'record.email' => 'required',
            'record.salario_basico' => 'required',
            'record.aporte_personal' => 'required',
            'record.rubro_appersonal' => 'required',
            'record.aporte_patronal' => 'required',
            'record.rubro_appatronal' => 'required',
            'record.aporte_secap' => 'required',
            'record.rubro_apsecap' => 'required',
            'record.aporte_iece' => 'required',
            'record.rubro_apiece' => 'required',
            'record.rubro_freserva' => 'required',
            'record.decimo_tercero' => 'required',
            'record.decimo_cuarto' => 'required',
            'record.vacaciones' => 'required',
        ]);
                
        if ($this->selectId){
            $record = TmCompania::find($this->selectId);
            $record->update([
                'razonsocial' => $this -> record['razonsocial'],
                'nombrecomercial' => $this -> record['nombrecomercial'],
                'ruc' => $this -> record['ruc'],
                'telefono' => $this -> record['telefono'],
                'provincia' => $this -> record['provincia'],
                'ciudad' => $this -> record['ciudad'],
                'canton' => $this -> record['canton'],
                'ubicacion' => $this -> record['ubicacion'],
                'representante' => $this -> record['representante'],
                'identificacion' => $this -> record['identificacion'],
                'website' => $this -> record['website'],
                'email' => $this -> record['email'],
                'salario_basico' => $this -> record['salario_basico'],
                'aporte_personal' => $this -> record['aporte_personal'],
                'rubro_appersonal' => $this -> record['rubro_appersonal'],
                'aporte_patronal' => $this -> record['aporte_patronal'],
                'rubro_appatronal' => $this -> record['rubro_appatronal'],
                'aporte_secap' => $this -> record['aporte_secap'],
                'rubro_apsecap' => $this -> record['rubro_apsecap'],
                'aporte_iece' => $this -> record['aporte_iece'],
                'rubro_apiece' => $this -> record['rubro_apiece'],
                'rubro_freserva' => $this -> record['rubro_freserva'],
                'decimo_tercero' => $this -> record['decimo_tercero'],
                'decimo_cuarto' => $this -> record['decimo_cuarto'],
                'extra25' => $this -> record['extra25'],
                'extra50' => $this -> record['extra50'],
                'extra100' => $this -> record['extra100'],
                'vacaciones' => $this -> record['vacaciones'],
                'elaborado' => $this -> record['elaborado'],
                'revisado' => $this -> record['revisado'],
                'visto_bueno' => $this -> record['visto_bueno'],
                'usuario' => auth()->user()->name,
            ]);
            
        }
              
    }

    public function deleteData(){
        TmCompania::find($this->selectId)->delete();
        $this->dispatch('hide-delete');
    }
}
