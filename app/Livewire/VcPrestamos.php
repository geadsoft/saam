<?php

namespace App\Livewire;
use App\Models\TmPersonas;
use App\Models\TmRubrosrol;
use App\Models\TmCatalogogeneral;
use App\Models\TmPeriodosrol;
use App\Models\TrPrestamosCabs;
use App\Models\TrPrestamosDets;
use App\Models\TmContratos;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VcPrestamos extends Component
{
    use WithPagination;

    public $rubroId, $fecha, $mesgracia = false, $fieldset, $editData = false; 
    public $record, $tblperiodos=[], $periodo, $anios, $eControl="", $selectValue, $selectId;
    public $cuotas=[];
    public $prestamoId, $activeTab = 'tabCab';

    public $estado=[
        'P' => ['estado' => 'Pendiente','color' => 'badge-soft-success'],
        'C' => ['estado' => 'Cancelado','color' => 'badge-soft-primary'],
        'X' => ['estado' => 'Anulado','color' => 'badge-soft-danger'],
    ];

    public function mount($id){
        
        $ldate = date('Y-m-d H:i:s');
        $this->periodo = date('Y',strtotime($ldate));
    
        $this->anios = TrPrestamosCabs::query()
        ->selectRaw('year(fecha) as periodo')
        ->groupByRaw('year(fecha)')
        ->get()->toArray();

        if(empty($this->anios)){
            $this->anio['periodo'] = $this->periodo;
        }
                
        if ($id!=""){
            $this->prestamoId = $id;
            $this->loadData();
        }else{
            $this->add();
        }

        $this->fieldset = "disabled";
    }
    
    public function render()
    {
        
        $tblpersonas = TmPersonas::query()
        ->where('estado','A')
        ->orderby('apellidos','asc')->get();
        $tblrubros   = TmRubrosrol::where('registro','PR')->get();
        $tbltipo     = TmCatalogogeneral::where('superior',5)->get();
        
        $this->rubroId = $tblrubros[0]['id'];

        $tblprestamos = TrPrestamosCabs::from('tr_prestamos_cabs as c')
        ->join('tm_personas as e','e.id','=','c.persona_id')
        ->leftJoin(DB::raw("
            (
                SELECT prestamo_id, COUNT(id) AS pagos
                FROM tr_prestamos_dets
                WHERE estado = 'C'
                GROUP BY prestamo_id
            ) p
        "), 'p.prestamo_id', '=', 'c.id')
        ->leftJoin(DB::raw("
        (
                SELECT prestamo_id, MAX(fecha) AS ultfecha
                FROM tr_prestamos_dets
                GROUP BY prestamo_id
            ) u
        "), 'u.prestamo_id', '=', 'c.id')
        ->whereYear('c.fecha', $this->periodo)
        ->select('c.*', 'u.ultfecha', 'p.pagos', 'e.apellidos', 'e.nombres')
        ->orderBy('c.id','desc')
        ->paginate(10);

        $prestamo = DB::table('tr_prestamos_cabs as c')
        ->leftJoin(DB::raw("
            (
                SELECT prestamo_id, SUM(valor) AS valor
                FROM tr_prestamos_dets
                WHERE estado = 'C'
                GROUP BY prestamo_id
            ) as d
        "), 'd.prestamo_id', '=', 'c.id')
        ->whereYear('c.fecha', $this->periodo)
        ->select(
            DB::raw('SUM(c.monto) as total'),
            DB::raw('COALESCE(SUM(d.valor),0) as cancelado'),
            DB::raw('SUM(c.monto) - COALESCE(SUM(d.valor),0) as porcancelar')
        )->first();

        return view('livewire.vc-prestamos',[
            'tblperiodos' => $this->tblperiodos,
            'tblpersonas' => $tblpersonas,
            'tblrubros' => $tblrubros,
            'tbltipo' => $tbltipo,
            'tblprestamos' =>  $tblprestamos,
            'prestamo' => $prestamo,
        ]);
        
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function loadData(){

        if ($this->prestamoId>0){
        
            $this->record  = TrPrestamosCabs::find($this->prestamoId)->toArray();
            $this->record['fecha'] = date('Y-m-d',strtotime($this->record['fecha']));
            $this->cuotas  = TrPrestamosDets::where('prestamo_id',$this->prestamoId)->get();

            $this->loadperiodo();

        }else{
            
            $this->tblrecord = TrPrestamosCabs::find($this->prestamoId);
            $this->add();
        }

    }

    public function add(){

        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        
        $this->reset(['record']);
        $this->record['nombres']= '';
        $this->record['fecha']= $this->fecha;
        $this->record['persona_id']= 0;
        $this->record['tipoprestamo_id']= 0;
        $this->record['rubrosrol_id']= 0;
        $this->record['periodosrol_id']= 0;
        $this->record['monto']= 0.00;
        $this->record['cuota']= 0;
        $this->record['valorcuota']= 0.00;
        $this->record['comentario']="";
        $this->record['ncuota']="";
        $this->record['ultimopago']="";
        $this->mesgracia = false;

        $this->cuotas=[];
        $this->fieldset="";
        $this->editData=false;

    }

    public function edit($recno){

        $this->prestamoId = $recno['id'];
        $this->record['persona_id'] = $recno['persona_id'];
        /*$this->loadperiodo();*/

        $this->view($recno);
        $this->fieldset="";
        $this->editData=true;
        $this->eControl="disabled";
        
    }

    public function view($recno){

        $this->tblperiodos = TmPeriodosrol::where('id',$recno['periodosrol_id'])
        ->get();

        $this->record['fecha']=  date('Y-m-d',strtotime($recno['fecha'])); 
        $this->record['persona_id']= $recno['persona_id'];
        $this->record['tipoprestamo_id']= $recno['tipoprestamo_id'];
        $this->record['rubrosrol_id']= $recno['rubrosrol_id'];
        $this->record['periodosrol_id']= $recno['periodosrol_id'];
        $this->record['monto']= $recno['monto'];
        $this->record['cuota']= $recno['cuota'];
        $this->record['ncuota']=$recno['cuota'];
        $this->record['ultimopago']=$recno['ultfecha'];
        $this->record['comentario']=$recno['comentario'];

        $this->cuotas = TrPrestamosDets::where('prestamo_id',$recno['id'])
        ->get()
        ->keyBy('cuota')
        ->toArray();

    }


    public function loadperiodo(){

        $tmcontrato  = TmContratos::where('persona_id',$this->record['persona_id'])->first();

        $this->tblperiodos = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->where('t.tipoempleado_id',$tmcontrato->tipoempleado_id)
        ->where('t.tipocontrato_id',$tmcontrato->tipocontrato_id)
        /*->where('tm_periodosrols.remuneracion','M')*/
        ->where('tm_periodosrols.procesado',0)
        ->select('tm_periodosrols.id','tm_periodosrols.fechafin')
        ->get();
              

    }

    public function calculaPagos(){

        if($this->editData){
            $this->newCuotas();
            return;
        }

        $montoTotal  = $this->record['monto'];
        $totalCuotas = $this->record['cuota'] ?? 0;
        $valorCuota  = $this->record['valorcuota'] ?? 0;
        $iniCuota = 1;

        /*if ($this->editData){
            
            $cuotasPagadas = collect($this->cuotas)
            ->where('estado', 'C');

            $iniCuota = collect($this->cuotas)
            ->where('estado', 'C')
            ->max('cuota');

            $totalPagado = $cuotasPagadas->sum('valor');
            $cantidadPagadas = $cuotasPagadas->count();

            $montoTotal  = $montoTotal-$totalPagado;
            $iniCuota=$iniCuota+1;
                      
        }*/

        // Validaciones
        if ($totalCuotas <= 0 && $valorCuota <= 0) {
            $this->addError('cuota', 'Debe indicar el número de cuotas o el valor de la cuota.');
            return;
        }

        if ($totalCuotas > 0 && $valorCuota > 0) {
            $this->addError('cuota', 'Indique solo el número de cuotas o el valor de la cuota, no ambos.');
            return;
        }

        if ($valorCuota > 0) {

            // Cuota fija → calcular número de cuotas
            $totalCuotas = (int) ceil($montoTotal / $valorCuota);

        } else {

            // Número de cuotas → calcular valor de la cuota
            $valorCuota = round($montoTotal / $totalCuotas, 2);

        }

        $pagos = 0;

        // Obtener fecha base
        // 🔐 Validación fuerte de fecha
        $periodo = collect($this->tblperiodos)
            ->firstWhere('id', $this->record['periodosrol_id']);

        if (!$periodo || empty($periodo['fechafin'])) {
            return; // o throw / addError
        }

        $fecha = Carbon::parse($periodo['fechafin'])->startOfMonth();

        // Mes de gracia
        if ($this->mesgracia) {
            $fecha->addMonth();
        }

        for ($numcuota = $iniCuota; $numcuota <= $totalCuotas; $numcuota++) {

            $fechaCuota = $fecha->copy()->endOfMonth();
            if ($periodo->remuneracion=='Q'){
                $fechaCuota = Carbon::parse($periodo['fechafin']);
            }
        
            // Ajuste última cuota
            $valor = ($numcuota == $totalCuotas)
                ? round($montoTotal - $pagos, 2)
                : $valorCuota;

            $pagos += $valor;

            if (isset($this->cuotas[$numcuota])) {

                if ($this->cuotas[$numcuota]['estado'] != 'C'){
                    $this->cuotas[$numcuota]['fecha'] = $fechaCuota->format('Y-m-d');
                    $this->cuotas[$numcuota]['valor'] = $valor;
                }
                
            } else{            
                $this->cuotas[$numcuota] = [
                    'cuota'  => $numcuota,
                    'fecha'  => $fechaCuota->format('Y-m-d'),
                    'valor'  => $valor,
                    'estado' => 'P',
                ];
            }

            $fecha->addMonth(); // siempre desde día 1
        }
        
        //$this->record['cuota'] = $numcuota-1;
    }

    public function newCuotas(){

        $montoTotal  = $this->record['monto'];
        $totalCuotas = $this->record['cuota'] ?? 0;
        $valorCuota  = $this->record['valorcuota'] ?? 0;
        $iniCuota = 1;
            
        $cuotasPagadas = collect($this->cuotas)
        ->where('estado', 'C');

        $iniCuota = collect($this->cuotas)
        ->where('estado', 'C')
        ->max('cuota');

        $totalPagado = $cuotasPagadas->sum('valor');
        $cantidadPagadas = $cuotasPagadas->count();

        $montoTotal  = $montoTotal-$totalPagado;
        $iniCuota    = $iniCuota+1;
        $fechaBase   = $this->cuotas[$iniCuota]['fecha'];

        // Validaciones
        if ($totalCuotas <= 0 && $valorCuota <= 0) {
            $this->addError('cuota', 'Debe indicar el número de cuotas o el valor de la cuota.');
            return;
        }

        if ($totalCuotas > 0 && $valorCuota > 0) {
            $this->addError('cuota', 'Indique solo el número de cuotas o el valor de la cuota, no ambos.');
            return;
        }

        if ($valorCuota > 0) {

            // Cuota fija → calcular número de cuotas
            $totalCuotas = (int) ceil($montoTotal / $valorCuota);

        } else {

            $valorCuota = round($montoTotal / ($totalCuotas-$cantidadPagadas), 2);
            
        }

        $pagos = 0;

        // Obtener fecha base
        // 🔐 Validación fuerte de fecha
        $periodo = collect($this->tblperiodos)
            ->firstWhere('id', $this->record['periodosrol_id']);

        if (!$periodo || empty($periodo['fechafin'])) {
            return; // o throw / addError
        }

        $fecha = Carbon::parse($fechaBase)->startOfMonth();

        // Mes de gracia
        if ($this->mesgracia) {
            $fecha->addMonth();
        }

        for ($numcuota = $iniCuota; $numcuota <= $totalCuotas; $numcuota++) {

            $fechaCuota = $fecha->copy()->endOfMonth();
            if ($periodo->remuneracion=='Q'){
                $fechaCuota = Carbon::parse($fecha);
            }
        
            // Ajuste última cuota
            $valor = ($numcuota == $totalCuotas)
                ? round($montoTotal - $pagos, 2)
                : $valorCuota;

            $pagos += $valor;

            if (isset($this->cuotas[$numcuota])) {

                if ($this->cuotas[$numcuota]['estado'] != 'C'){
                    $this->cuotas[$numcuota]['fecha'] = $fechaCuota->format('Y-m-d');
                    $this->cuotas[$numcuota]['valor'] = $valor;
                }
                
            } else{            
                $this->cuotas[$numcuota] = [
                    'id'     => 0,
                    'cuota'  => $numcuota,
                    'fecha'  => $fechaCuota->format('Y-m-d'),
                    'valor'  => $valor,
                    'estado' => 'P',
                ];
            }

            $fecha->addMonth(); // siempre desde día 1
        }
        
    }

    public function updated($property, $value)
    {
        if (str_starts_with($property, 'cuotas.') && str_ends_with($property, '.fecha')) {

            $numCuota = explode('.', $property)[1];

            $this->recalcularFechas((int)$numCuota);
        }
    }

    public function recalcularFechas($cuotaBase)
    {
        if (!isset($this->cuotas[$cuotaBase])) {
            return;
        }

        // Forzamos cuota base al último día
        $fechaBase = Carbon::parse($this->cuotas[$cuotaBase]['fecha'])
                        ->endOfMonth();

        $this->cuotas[$cuotaBase]['fecha'] = $fechaBase->format('Y-m-d');

        foreach ($this->cuotas as $nro => &$cuota) {

            if ($nro > $cuotaBase && $cuota['estado'] == 'P') {

                // Nos movemos al primer día del siguiente mes
                $fechaBase = $fechaBase->copy()
                    ->addMonthNoOverflow()
                    ->startOfMonth()
                    ->endOfMonth();

                $cuota['fecha'] = $fechaBase->format('Y-m-d');
            }
        }
    }

    public function createData(){

        $this ->validate([
            'record.fecha' => 'required',
            'record.persona_id' => 'required',
            'record.tipoprestamo_id' => 'required',
            'record.rubrosrol_id' => 'required',
            'record.periodosrol_id' => 'required',
            'record.monto' => 'required',
            'record.cuota' => 'required',
            'record.comentario' => 'required',
        ]);

        if($this->editData){
            $this->updateData();
        }

        $trPrestamoCabs = TrPrestamosCabs::Create([
            'fecha' => $this -> record['fecha'],
            'persona_id' => $this -> record['persona_id'],
            'tipoprestamo_id' => $this -> record['tipoprestamo_id'],
            'rubrosrol_id' => $this -> record['rubrosrol_id'],
            'periodosrol_id' => $this -> record['periodosrol_id'],
            'monto' => $this -> record['monto'],
            'cuota' => $this -> record['cuota'],
            'comentario' => $this -> record['comentario'],
            'usuario' => auth()->user()->name,
            'estado' => 'P',
        ]);

        $this->prestamoId = $trPrestamoCabs->id;

        foreach ($this->cuotas as $data){
            
            TrPrestamosDets::Create([
                'prestamo_id' => $this->prestamoId,
                'cuota' => $data['cuota'],
                'fecha' => $data['fecha'],
                'valor' => $data['valor'],
                'estado' => 'P',
                'usuario' => auth()->user()->name,
            ]);

        }

        $this->dispatch('msg-grabar'); 
        return redirect()->to('/payroll/prestamos/');
       
    }

    public function updateData(){

        $this ->validate([
            'record.fecha' => 'required',
            'record.persona_id' => 'required',
            'record.tipoprestamo_id' => 'required',
            'record.rubrosrol_id' => 'required',
            'record.periodosrol_id' => 'required',
            'record.monto' => 'required',
            'record.cuota' => 'required',
            'record.comentario' => 'required',
        ]);

        $cab = TrPrestamosCabs::find($this->prestamoId);
        $cab->update([
            'cuota' => $this -> record['cuota'],
        ]);

        foreach ($this->cuotas as $data){

            if ($data['id']==0){

                TrPrestamosDets::Create([
                    'prestamo_id' => $this->prestamoId,
                    'cuota' => $data['cuota'],
                    'fecha' => $data['fecha'],
                    'valor' => $data['valor'],
                    'estado' => 'P',
                    'usuario' => auth()->user()->name,
                ]);

            }else{

                $prestamo = TrPrestamosDets::find($data['id']);
                $prestamo->Update([
                    'cuota' => $data['cuota'],
                    'fecha' => $data['fecha'],
                    'valor' => $data['valor'],
                ]);

            }

        }

        $this->dispatch('msg-grabar'); 
        return redirect()->to('/payroll/prestamos/');
    
    }

    public function delete( $id ){
        
        $this->prestamoId = $id;
        $record = TrPrestamosCabs::find($this->prestamoId);
        $this->selectValue = $record->persona->apellidos.' '.$record->persona->nombres;

        $this->dispatch('show-delete');

    }

    public function deleteData(){

        $cab = TrPrestamosCabs::find($this->prestamoId);
        $cab->update([
            'estado' => 'X',
        ]);

        TrPrestamosDets::where('prestamo_id',$this->prestamoId)->update([
            'estado' => 'X',
        ]);

        $this->dispatch('hide-delete');
    }

    public function selectTab($tab)
    {
        $this->activeTab = $tab;
    
    }

}
