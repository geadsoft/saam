<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class VcPanelBalanceRefineria extends Component
{
    public $balance;
    
    public $filters=[
        'startDate' => '20260101',
        'endDate' => '20260131',
    ];

    public function mount()
    {
        $this->consulta();
    }
    
    public function render()
    {
        return view('livewire.vc-panel-balance-refineria');
    }

    public function consulta(){

        $response = Http::get('http://181.198.111.178/api-erp/api/balance-masico', [
            'startDate' => $this->filters['startDate'],
            'endDate' => $this->filters['endDate'],
        ]);
        $this->balance= collect($response->object())
        ->values();

    }
}
