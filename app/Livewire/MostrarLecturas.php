<?php

namespace App\Livewire;
use App\Models\LecturaCom;
use Livewire\Component;

class MostrarLecturas extends Component
{
    public $lecturas;

    public function render()
    {
        $this->lecturas = LecturaCom::latest()->take(10)->get();
        return view('livewire.mostrar-lecturas');
    }

}
