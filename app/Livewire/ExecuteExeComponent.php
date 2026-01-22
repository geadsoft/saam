<?php

namespace App\Livewire;

use Livewire\Component;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class ExecuteExeComponent extends Component
{   
    public $output = '';
    public $error = '';

    public function runExecutable()
    {
        // Define la ruta completa a tu archivo .exe
        // Asegúrate de usar las barras invertidas correctamente escapadas en Windows
        $executablePath = 'C:\\Bascula\\bascula.exe';

        // Si necesitas pasar argumentos
        $arguments = ['arg1', 'arg2'];

        $process = new Process(array_merge([$executablePath], $arguments));

        try {
            $process->run();

            // Ejecuta después de que el comando termina
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $this->output = $process->getOutput();
            $this->error = $process->getErrorOutput();

        } catch (ProcessFailedException $exception) {
            $this->error = $exception->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.execute-exe-component');
    }
}
