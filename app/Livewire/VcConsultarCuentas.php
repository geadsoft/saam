<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\TmCuentasContables;

class VcConsultarCuentas extends Component
{
    public $query;
    public $contacts;
    public $highlightIndex;
    public $codCuenta;

    protected $listeners = ['getCuenta'];

    public function mount()
    {
        $this->load();
    }

    public function load()

    {

        $this->query = '';
        $this->contacts = [];
        $this->highlightIndex = 0;
        $this->codCuenta = '';

    }

 

    public function incrementHighlight()

    {

        if ($this->highlightIndex === count($this->contacts) - 1) {

            $this->highlightIndex = 0;

            //return;

        }

        $this->highlightIndex++;

    }

 

    public function decrementHighlight()

    {

        if ($this->highlightIndex === 0) {

            $this->highlightIndex = count($this->contacts) - 1;

            //return;

        }

        $this->highlightIndex--;

    }

    public function selectContact($codigo)

    {
        //$contacts = $this->contacts[$this->highlightIndex] ?? null;
        $contacts = DB::connection('sqlsrv')->table('SGI_Con_Catalogo')
        ->whereRaw("codigo = '".$codigo."'")
        ->where('ejercicio', 2024)
        ->where('auxiliar', 1)
        ->get();

        if ($contacts) {
            
            $this->load();
            $this->codCuenta =  $codigo;
            $this->query =  $contacts[0]->Nombre; 
            
        }

    }

    public function updatedQuery()
    {
        $this->contacts  = DB::connection('sqlsrv')->table('SGI_Con_Catalogo')
        ->when($this->query,function($query){
            return $query->whereRaw("nombre like '%".$this->query."%'");
        })
        ->where('ejercicio', 2024)
        ->where('auxiliar', 1)
        ->get();
                
    } 

    public function getCuenta($idEnlace)
    {

        $record = TmCuentasContables::find($idEnlace);
        $record->update([
            'cuenta' => $this->codCuenta,
            'descripcion' => $this->query,
        ]);

    } 

    public function render()
    {

        return view('livewire.vc-consultar-cuentas');

    }
}
