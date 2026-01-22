<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class VcAnalisisCalidad extends Component
{
    use WithPagination;
    
    public $showEditModal=false, $selectValue, $selectId=0;
    public $tblproductos, $calidad;
    public $filters=[
        'producto' => ''
    ];

    public function mount(){

        $this->tblproductos = DB::connection('sqlsrv')
        ->table('SGI_Inv_Productos')
        ->where('certificado',1)
        ->get();

        $producto = $this->tblproductos->first()->codigo;
        $this->filters['producto'] = $producto;
    }
        
    public function render()
    {
        $tblrecords = DB::connection('sqlsrv')
        ->table('Erp_Inv_RubrosCalidad')
        ->where('producto',$this->filters['producto'])
        ->paginate(10);
        
        return view('livewire.vc-analisis-calidad',[
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        
        $this->calidad=[
            'nombre' => '',
            'minimo' => 0,
            'maximo' => 0,
            'metodo' => '',
            'etiqueta' => '',
            'producto' => $this->filters['producto'],
        ];

        $this->dispatch('show-form');
    }

    public function edit($id){
        
        $this->showEditModal = true;

        $record =  DB::connection('sqlsrv')
        ->table('Erp_Inv_RubrosCalidad')
        ->where('id_fila',$id)
        ->first();
        
        $this->calidad=[
            'nombre' => $record->nombre,
            'minimo' => $record->minimo,
            'maximo' => $record->maximo,
            'metodo' => $record->metodo,
            'etiqueta' => $record->etiqueta,
            'producto' => $record->producto,
        ];

        $this->selectId = $record->id_fila;
        $this->dispatch('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;

        $record =  DB::connection('sqlsrv')
        ->table('Erp_Inv_RubrosCalidad')
        ->where('id_fila',$id)
        ->first();

        $this->selectValue = $record->nombre;

        $this->dispatch('show-delete');

    }

    public function createData(){
        
        $this ->validate([
            'calidad.nombre' => 'required',
            'calidad.minimo' => 'required',
            'calidad.maximo' => 'required',
            'calidad.metodo' => 'required',
            'calidad.producto' => 'required',
        ]);

        DB::connection('sqlsrv')->table('Erp_Inv_RubrosCalidad')->insert($this->calidad);
        $this->dispatch('hide-form');
        
        $this->dispatch('msg-grabar');
    }

    public function updateData(){

        $this ->validate([
            'calidad.nombre' => 'required',
            'calidad.minimo' => 'required',
            'calidad.maximo' => 'required',
            'calidad.metodo' => 'required',
            'calidad.producto' => 'required',
        ]);

        DB::connection('sqlsrv')
        ->table('Erp_Inv_RubrosCalidad')
        ->where('id_fila',$this->selectId) 
        ->update($this->calidad);
            
        $this->dispatch('hide-form');
        $this->dispatch('msg-actualizar');
        
    }

    public function deleteData(){

        $record =  DB::connection('sqlsrv')
        ->table('Erp_Inv_RubrosCalidad')
        ->where('id_fila',$id)
        ->first();

        /*$record->update([
            'estado' => 'I',
        ]);*/

        $this->dispatch('hide-delete');
    }

    
}
