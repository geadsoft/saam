<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VcPlanCuentas extends Component
{
  
    public $fecha;
    public $lnperiodo;
    public $mes;
    public $expanded = [];        // códigos expandidos en el nivel raíz
    public $allAccounts = [];     // TODOS los registros cargados (array)
    public $nivel = 0;

    public $arrsaldo = [
        '01' => 'sa01_sal','02' => 'sa02_sal','03' => 'sa03_sal','04' => 'sa04_sal',
        '05' => 'sa05_sal','06' => 'sa06_sal','07' => 'sa07_sal','08' => 'sa08_sal',
        '09' => 'sa09_sal','10' => 'sa10_sal','11' => 'sa11_sal','12' => 'sa12_sal'
    ];

    public function mount()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d', strtotime($ldate));
        $this->mes = date('m', strtotime($ldate));

        // traer periodo
        $tblcia = DB::connection('sqlsrv')->select('exec sp_Gen_SGI_Cias 3');
        $this->lnperiodo = $tblcia[0]->ejercicio;

        $campo = $this->arrsaldo[$this->mes];

        // Cargar todo el plan UNA sola vez y convertir a array
        $this->allAccounts = DB::connection('sqlsrv')
            ->table('SGI_Con_Catalogo as c')
            ->join('SGI_Con_Saldos as s', function ($join) {
                $join->on('s.codigo', '=', 'c.codigo')
                     ->on('s.ejercicio', '=', 'c.ejercicio');
            })
            ->select('c.codigo', 'c.nombre', DB::raw("s.{$campo} as saldo"), 'c.CtaMayor', 'c.auxiliar')
            ->where('c.ejercicio', $this->lnperiodo)
            ->orderBy('c.codigo')
            ->get()
            ->map(function($r){ return (array) $r; })
            ->toArray();
    }

    // toggle expand/collapse (reindexa al eliminar)
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
        // raíces: CtaMayor vacío o null y que pertenezcan a los grupos 1..6
        $roots = collect($this->allAccounts)
        ->filter(function($c){
            return in_array($c['codigo'], ['1','2','3','4','5','6','7','8','9']);
        })
        ->values()
        ->all();

        return view('livewire.vc-plan-cuentas', [
            'cuentas' => $roots,
            'allAccounts' => $this->allAccounts,
        ]);
    }

}
