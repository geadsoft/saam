<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class VcCalificaFruta extends Component
{
    public $rCalifica = [];
    public $record=[
        'muestreo' =>0,
        'pesoneto' =>0,
        'precio' => 0,
        'castigo' => 0,
        'netonormal' => 0,
    ];

    public function mount($id){
        $this->loadData();
    }
    
    public function render()
    {
        return view('livewire.vc-califica-fruta');
    }

    #[On('setPesoNeto')]
    public function setPesoNeto($valor, $precio)
    {
        $this->record['pesoneto'] = $valor;
        $this->record['precio'] = $precio;
    }

    public function loadData()
    {
        $rubros = DB::connection('sqlsrv')
        ->table('SGI_CXP_Castigo_Proveedores')
        ->get();

        foreach ($rubros as $key => $rubro){
            $this->rCalifica[$key] = [
                'codigo'       => $rubro->Id_Fila,
                'detalle'      => $rubro->Nombre,
                'tolerancia'   => $rubro->Tolerancia,
                'precio'       => $rubro->Porcentaje,
                'racimos'      => "",
                'calificacion' => 0,
                'uso'          => 0,
                'peso'         => 0,
                'monto'        => 0,
            ];
        }

    }

    public function calificaFruta($i)
    {
        if (!isset($this->record['muestreo']) || $this->record['muestreo'] <= 0) {
            $this->addError('record.muestreo', 'Debe seleccionar muestreo de racimos.');
            return;
        }
        $this->resetErrorBag('record.muestreo');

        $valor = $this->record['muestreo'];
        $racimos = $this->rCalifica[$i]['racimos'];
        $tolerancia = $this->rCalifica[$i]['tolerancia'];

        $this->rCalifica[$i]['calificacion'] = round(($racimos/$valor)*100,2);
        $this->rCalifica[$i]['uso'] = $this->rCalifica[$i]['calificacion']-$tolerancia;
        $this->rCalifica[$i]['peso'] = $this->record['pesoneto']*($this->rCalifica[$i]['uso']/100);
        $this->rCalifica[$i]['monto'] = (($this->record['pesoneto']/1000)*$this->record['precio'])*($this->rCalifica[$i]['peso']/100);
        
        $castigo = array_sum(array_column($this->rCalifica,'peso'));
        $this->record['castigo'] = $castigo;
        $this->record['netonormal'] = $this->record['pesoneto']-$castigo;

    }

    #[On('grabaCalificacion')]
    public function grabaCalificacion($id)
    {
        $data = [];

        foreach($this->rCalifica as $califica){

            if (!isset($califica['racimos']) || (int)$califica['racimos'] === 0) {
                continue;
            }
                
            $data[] = [
                'Id_PesoBascula' => $id,
                'Id_PesoTraslado' => 0,
                'Id_Calificacion' => $califica['codigo'],
                'Racimos' => $califica['racimos'],
                'Porcentaje_Tolerancia' => $califica['tolerancia'],
                'Porcentaje_Precio' => $califica['precio'],
                'Porcentaje_Calificacion' => $califica['calificacion'],
                'Porcentaje_Base' => $califica['uso'],
                'Peso_Neto' => $califica['peso'],
                'Total_Pagar' => $califica['monto'],
            ];

        }

        $peso = DB::connection('sqlsrv')
            ->table('inv.tbl_tm_pesobascula as b')
            ->where('id_fila',$id)
            ->firts();

            $peso->update([
                'muestreo'=> $record['muestreo'],
            ]);

        // El array se inserta solo si tiene elementos
        if (!empty($data)) {
            DB::connection('sqlsrv')
                ->table('inv.Tbl_Tm_PesoBascula_Califica')
                ->insert($data);
        }

    }
}
