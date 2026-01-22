<?php

namespace App\Livewire;

use Livewire\Component;

class VcCalendario extends Component
{
    public $showEditModal = false;
    
    public function render()
    {
        return view('livewire.vc-calendario');
    }

    
    
}
