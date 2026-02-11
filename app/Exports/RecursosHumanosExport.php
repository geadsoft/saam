<?php

namespace App\Exports;
use App\Models\TcRolPagos;
use App\Models\TdRolPagos;
use App\Models\TmCuentasContables;
use App\Models\TmPersonas;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class RecursosHumanosExport implements FromView, WithColumnWidths, WithStyles, WithEvents
{
    use Exportable;

    public $countColumnas, $colum;
    protected $rolpagoId;

    public $mes=[
        1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre",
    ];

    public function __construct($rolpagoId)
    {
        $this->rolpagoId = $rolpagoId;
    }

    public function view(): View 
    { 
        $provision = TmCuentasContables::query()
        ->join('tm_rubrosrols as r','r.id','=','tm_cuentas_contables.rubro_id')
        ->select('tm_cuentas_contables.rubro_id','r.etiqueta')
        ->where('tm_cuentas_contables.comprobante','P')
        ->groupBy('rubro_id','r.etiqueta')
        ->get();

        $cab = TcRolPagos::query()
        ->join('tm_tiposrols as t','t.id','=','tc_rol_pagos.tiposrol_id')
        ->select('tc_rol_pagos.*','t.descripcion','t.tipoempleado_id')
        ->where('tc_rol_pagos.id',$this->rolpagoId)
        ->first();
        
        $det = TdRolPagos::query()
        ->join('tm_personas as p','p.id','=','td_rol_pagos.persona_id')
        ->join('tm_rubrosrols as r','r.id','=','td_rol_pagos.rubrosrol_id')
        ->select('p.nui','r.tipo','r.etiqueta','r.id','td_rol_pagos.valor')
        ->where('td_rol_pagos.rolpago_id',$this->rolpagoId)
        ->get();

        $tot = TdRolPagos::query()
        ->join('tm_personas as p','p.id','=','td_rol_pagos.persona_id')
        ->select('p.nui','td_rol_pagos.rubro_total','td_rol_pagos.valor')
        ->where('td_rol_pagos.rolpago_id',$this->rolpagoId)
        ->get();

        $rubros = TdRolPagos::query()
        ->join('tm_rubrosrols as r','r.id','=','td_rol_pagos.rubrosrol_id')
        ->where('td_rol_pagos.rolpago_id', $this->rolpagoId)
        ->whereNotIn('r.id', function ($query) {
            $query->select('rubro_id')
                ->from('tm_cuentas_contables')
                ->where('comprobante', 'P');
        })
        ->select('r.id','r.tipo','r.etiqueta')
        ->groupBy('r.id','r.tipo','r.etiqueta')
        ->orderByDesc('r.tipo')
        ->orderBy('r.id')
        ->get();


        $rubrosAgrupados = $rubros
        ->groupBy('tipo')
        ->map(function ($items) {
                return $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'etiqueta' => $item->etiqueta,
                ];
            })->values();
        });

        $personas = TmPersonas::query()
        ->join('tm_contratos as c','c.persona_id','=','tm_personas.id')
        ->join('tm_areas as a','a.id','c.departamento_id')
        ->select('tm_personas.nui','tm_personas.nombres','tm_personas.apellidos','a.descripcion as area')
        ->where('c.tipoempleado_id',$cab->tipoempleado_id)
        ->get();

        foreach($personas as $person){
            $id = $person->nui;
            $this->detalle[$id]['nui'] = $person->nui;
            $this->detalle[$id]['nombres'] = $person->apellidos.'  '.$person->nombres;
            $this->detalle[$id]['area'] = $person->area;
            $this->detalle[$id]['HE25']  = 0;
            $this->detalle[$id]['HE50']  = 0;
            $this->detalle[$id]['HE100'] = 0;

            foreach($rubrosAgrupados as $key => $rubros){
                
                foreach($rubros as $rubro){
                    $rubroId = $rubro['id'];
                    $this->detalle[$id][$rubroId] = 0;
                }
                if ($key=='P'){
                    $this->detalle[$id]['TOTING'] = 0;
                }else{
                    $this->detalle[$id]['TOTEGR'] = 0;
                }
               
            }
            $this->detalle[$id]['TOTPAG'] = 0;
            $this->detalle[$id]['fpago'] = '';
            $this->detalle[$id]['ctabco'] = '';
            $this->detalle[$id]['tipocta'] = '';
            $this->detalle[$id]['bco'] = '';
        }

        foreach($personas as $person){
            $id = $person->nui;
            foreach($provision as $provs){
                $rubroId = $provs->rubro_id;
                $this->detalle[$id][$rubroId] = 0;
            }
        }

        //Asigna Valor
        foreach($det as $recno){
            $personaId = $recno->nui;
            $rubroId = $recno->id;
            $this->detalle[$personaId][$rubroId] = $recno->valor;
        }

        foreach($tot as $recno){
            $personaId = $recno->nui;
            $rubroId = $recno->rubro_total;
            $this->detalle[$personaId][$rubroId] = $recno->valor;
        }
        
        $this->colum=[
            'ing' => count($rubrosAgrupados['P']),
            'egr' => count($rubrosAgrupados['D']),
            'pro' => count($provision),
            'tot' => count($rubrosAgrupados['P'])+count($rubrosAgrupados['D'])+count($provision)+13,
            'fil' => count($personas),
        ];

        $this->countColumnas = count(reset($this->detalle));

        return view('export.NominaGeneral',[
            'colspan' => $this->colum,
            'cab'  => $cab,
            'rubros' => $rubrosAgrupados,
            'records' => $this->detalle,
            'provision' => $provision,
            'mes' => $this->mes,
        ]);


    }

    public function columnWidths():array{
        
        $widths = [
            'A' => 11,
            'B' => 40,
            'C' => 15,
        ];

        $column = $this->colum['ing']+$this->colum['egr']+8;

        for ($i = 4; $i <= $column; $i++) { // 3 = C, 24 = X
            $columna = Coordinate::stringFromColumnIndex($i);
            $widths[$columna] = 15;
        }

        return $widths;
    }

    public function styles(Worksheet $sheet)
    {
        $countColumn = $this->colum['ing']+$this->colum['egr']+$this->colum['pro']+6;
        $letraColumna = Coordinate::stringFromColumnIndex($countColumn);
       
        $fila1 = 'A1:'.$letraColumna.'1';
        $fila2 = 'A2:'.$letraColumna.'2';
        $sec1 = 'A5:C5';

        $letraCol  = $this->colum['ing']+1;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec2 = 'D5:'.$celda;

        $letraCol  = $this->colum['ing']+8;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec3 = $celda.':';
        $letraCol = $letraCol+$this->colum['egr']+1;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec3 = $sec3.$celda;

        $letraCol  = $this->colum['ing']+$this->colum['egr']+9;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec4 = $celda.':';
        $letraCol = $this->colum['ing']+$this->colum['egr']+13;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec4 = $sec4.$celda;

        $letraCol = $letraCol+1;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec4 = $celda.':';
        $letraCol = $this->colum['ing']+$this->colum['egr']+$this->colum['pro']+13;
        $celda = Coordinate::stringFromColumnIndex($letraCol).'5';
        $sec4 = $sec4.$celda;

        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'font' => [
                'bold' => true,
            ]
        ];
        $sheet->getStyle($fila1)->applyFromArray($style);
        $sheet->getStyle($fila2)->applyFromArray($style);
        $sheet->getStyle($sec1)->applyFromArray($style);
        $sheet->getStyle($sec2)->applyFromArray($style);
        $sheet->getStyle($sec3)->applyFromArray($style);
        $sheet->getStyle($sec4)->applyFromArray($style);
        $sheet->getStyle($sec5)->applyFromArray($style);

        $countColumn = $this->colum['ing']+$this->colum['egr']+$this->colum['pro']+13;
        $letraColumna = Coordinate::stringFromColumnIndex($countColumn);
        $celda = $letraColumna.$this->colum['fil']+6;
        $sheet->getStyle('D7:'.$celda)
        ->getNumberFormat()
        ->setFormatCode('#,##0.00');
        
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
    
                $sheet = $event->sheet->getDelegate();
    
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                //$highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
                $highestColumnIndex = $this->colum['ing']+$this->colum['egr']+9;
                $totalRow = $highestRow + 1;
    
                // Texto TOTAL
                $sheet->setCellValue('C' . $totalRow, 'TOTALES =>');
    
                // Desde columna D (4) en adelante
                for ($col = 4; $col <= $highestColumnIndex; $col++) {
    
                    $columnLetter = Coordinate::stringFromColumnIndex($col);
    
                    $sheet->setCellValue(
                        $columnLetter . $totalRow,
                        "=SUM({$columnLetter}7:{$columnLetter}{$highestRow})"
                    );
                }

                $colini = $highestColumnIndex+5;
                $highestColumnIndex = $highestColumnIndex+$this->colum['pro']+4;
                for ($col = $colini; $col <= $highestColumnIndex; $col++) {
    
                    $columnLetter = Coordinate::stringFromColumnIndex($col);
    
                    $sheet->setCellValue(
                        $columnLetter . $totalRow,
                        "=SUM({$columnLetter}7:{$columnLetter}{$highestRow})"
                    );
                }

                // Negrita en fila total
                $sheet->getStyle("A{$totalRow}:{$highestColumn}{$totalRow}")
                    ->getFont()
                    ->setBold(true);
            },
        ];
    }

}


