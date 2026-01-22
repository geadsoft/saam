<?php

namespace App\Livewire;
use App\Models\LecturaCom;
use Livewire\Component;
use Livewire\Attributes\On;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class VcLecturaBascula extends Component
{   
    public $lecturas=[]; 
    public $selectId, $pesoBruo, $pesoTara, $pesoNeto;
    
    public function mount($id)
    {
        $this->selectId = $id; 
    }

    protected $listeners = [
        'abrirpuerto' => 'abrirpuerto',
    ];

    public function render()
    {
        //$this->lecturas = LecturaCom::latest()->take(1)->get();
        return view('livewire.vc-lectura-bascula');
    }

    #[On('abrirPuerto')]
    public function abrirPuerto(){
       
        $puerto = 'COM3';
        $process = new Process([
            'node',
            'C:\NodeJs\server\index.js',
            $puerto
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new \Exception($process->getErrorOutput());
        }

        $output = $process->getOutput();
        dd($output);
    }


}
