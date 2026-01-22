<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VcSubnivelCuentas extends Component
{
    public $parentCode;     // código de la cuenta padre de este subcomponente
    public $nivel = 1;
    public $allAccounts = []; // recibe TODOS los registros (array)
    public $expanded = [];   // expandidos en ESTE subcomponente

    public function mount($parentCode = null, $nivel = 1, $allAccounts = [])
    {
        $this->parentCode = $parentCode;
        $this->nivel = $nivel;
        // aseguramos que sea array serializable
        $this->allAccounts = is_array($allAccounts) ? $allAccounts : (array) $allAccounts;
    }

    public function toggleChildren($codigo)
    {
        $pos = array_search($codigo, $this->expanded);
        if ($pos !== false) {
            unset($this->expanded[$pos]);
            $this->expanded = array_values($this->expanded);
        } else {
            $this->expanded[] = $codigo;
        }
    }

    public function render()
    {
        $parent = (string) $this->parentCode;

        $hijos = collect($this->allAccounts)
            ->filter(function($c) use ($parent) {
                return (string) $c['CtaMayor'] === $parent;
            })
            ->values()
            ->all();

        return view('livewire.vc-subnivel-cuentas', [
            'children' => $hijos,
            'expanded' => $this->expanded,
            'allAccounts' => $this->allAccounts,
            'nivel' => $this->nivel,
            'parentCode' => $this->parentCode,
        ]);
    }
}