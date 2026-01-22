<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Schema;

class VcIncrementalProveedor extends Component
{
    public $query = '';
    public $results = [];
    public $highlightIndex = 0;
    public $selectId;

    public function mount($nombre)
    {
        $this->borrar();
        $this->query=$nombre;
        
    }

    public function borrar()
    {
        $this->query = "";
        $this->results = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if (count($this->results) === 0) {
            $this->highlightIndex = 0;
            return;
        }

        if ($this->highlightIndex >= count($this->results) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if (count($this->results) === 0) {
            $this->highlightIndex = 0;
            return;
        }

        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->results) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    
    public function selectStudent()
    {
        $this->selectStudentByIndex($this->highlightIndex);
    }

    
    public function selectStudentByIndex($index)
    {
        $result = $this->results[$index] ?? null;

        if (! $result) {
            return $this->borrar();
        }

        $this->borrar();

        $this->selectId = $result['Id_Fila'] ?? ($result->Id_Fila ?? null);
        $this->query = $result['Nombre'] ?? ($result->Nombre ?? null);
        $this->dispatch('set-proveedor', codigo: $this->selectId);
    }

    public function updatedQuery($value)
    {
        $value = trim($value);

        if (strlen($value) < 2) {
            $this->results = [];
            $this->highlightIndex = 0;
            return;
        }

        $rows = DB::connection('sqlsrv')
            ->table('SGI_Cxp_Catalogo')
            ->selectRaw('Id_Fila, Codigo, Nombre, Nombre_Comercial')
            ->where('Nombre', 'like', '%' . $value . '%')
            ->limit(10)
            ->get();

        $this->results = $rows->map(function ($row) {
            return (array) $row;
        })->toArray();

        
        $this->highlightIndex = 0;
        $this->selectId = 0;
    }

    public function render()
    {
        return view('livewire.vc-incremental-proveedor');
    }
}
