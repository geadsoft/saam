<?php

namespace App\Console\Commands;

use App\Models\TmPersonas;
use Illuminate\Console\Command;
use App\Services\VacationPeriodGenerator;


class GenerateVacationPeriods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vacations:generate-periods';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        TmPersonas::chunk(100, function ($personas) {
            foreach ($personas as $persona) {
                VacationPeriodGenerator::generateForPersona($persona->id);
            }
        });

        $this->info('Períodos de vacaciones generados correctamente.');
    }
}
