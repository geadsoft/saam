<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Schema;

class VcIncrementalChofer extends Component
{
    public $query = '';
    public $results = [];
    public $highlightIndex = 0;
    public $selectId;

    protected $listeners = [
        'setChofer' => 'setChofer'
    ];

    public function mount($nombre)
    {   
        $this->borrar();
        $this->query = $nombre;
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

    /**
     * Selección cuando el usuario presiona Enter.
     * Usa el highlightIndex actual.
     */
    public function selectStudent()
    {
        $this->selectStudentByIndex($this->highlightIndex);
    }

    /**
     * Selección al hacer click en una fila (recibe el índice).
     */
    public function selectStudentByIndex($index)
    {
        $result = $this->results[$index] ?? null;

        if (! $result) {
            return $this->borrar();
        }

        // Finalmente, limpiar el input y resultados
        $this->borrar();

        $this->selectId = $result['Id_Fila'] ?? ($result->Id_Fila ?? null);
        $this->query = $result['Nombre'] ?? ($result->Nombre ?? null);
        $this->dispatch('set-chofer', codigo: $this->selectId);
        
    }

    /**
     * Se dispara automáticamente cuando cambia $query.
     * Aseguramos devolver arrays asociativos y limitamos resultados.
     */
    public function updatedQuery($value)
    {
        $value = trim($value);

        if (strlen($value) < 2) {
            $this->results = [];
            $this->highlightIndex = 0;
            return;
        }

        $rows = DB::connection('sqlsrv')
            ->table('sgi_inv_choferes')
            ->selectRaw('Id_Fila, Nombre')
            ->where('Nombre', 'like', '%' . $value . '%')
            ->limit(10)
            ->get();

        // Convertir a array asociativo para que el blade use siempre $result['Nombre']
        $this->results = $rows->map(function ($row) {
            return (array) $row;
        })->toArray();

        
        $this->highlightIndex = 0;
        $this->selectId = 0;
    }
    
    public function render()
    {
        return view('livewire.vc-incremental-chofer');
    }

    
}
