<?php

namespace App\Livewire;
use App\Models\LecturaCom;
use App\Models\TdSucursalUsuarios;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;


class VcPesoCompras extends Component
{
    public $selectId, $lecturas=[], $pesoTara, $pesoBruto=0, $fieldset="", $config, $pesoManual="N";
    public $activeTab1='active', $activeTab2, $activeTab3;
    public $showTab1 = 'active show', $showTab2, $showTab3;
    public $fecha, $hora, $fechaHora, $time="";
    public $tblplacas = [], $persona;
    public $racimos=[];
    public $pago=[];

    public $record;
    
    public $activeTab =[
        'T1' => "active",
        'S1' => "active show",
        'T2' => "",
        'S2' => "",
        'T3' => "",
        'S3' => "",
    ];

    protected $listeners = [
        'runExecutable' => 'runExecutable',
        'requestRun' => 'requestRun'
    ];

    public $diasem=[
        "Mon" => "Lunes",
        "Tue" => "Martes",
        "Wed" => "Miércoles",
        "Thu" => "Jueves",
        "Fri" => "Viernes",
        "Sat" => "Sabádo",
        "Sun" => "Domingo"
    ];

    public function mount($id)
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        $this->hora = date('H:i:s',strtotime($ldate));
        $this->fechaHora = Carbon::now()->format('d M Y - h-iA');
        
        $this->selectId = $id;

        //Sucursal
        $sucursal = TdSucursalUsuarios::where('usuario_id',auth()->user()->id)->first();
       
        $this->config = DB::connection('sqlsrv')
        ->table('sgi_config.dbo.SGI_Usuarios as u')
        ->join('sgi_config.dbo.SGI_Cias as c','u.Sucursal','=','c.NumeroCia')
        ->whereRaw('Sucursal>0 and c.EntregaFruta is not null')
        ->where('u.usuario',$sucursal->usuario)
        ->select('u.usuario','u.sucursal','configbg','configbp','puertog','puertop','oficina')
        ->first();

        if ($this->selectId==0 ){
            $this->addData();
        }else{
            $this->loadData();
        }
    }

    public function render()
    {   
        
        $lecturas = LecturaCom::query()
        ->where('usuario_id',auth()->user()->id)
        ->where('sucursal',$this->config->sucursal)
        ->where('proceso',($this->config->oficina==1) ? 'CFM' : 'CFA')
        ->first();

        if($lecturas){

            if ($lecturas->valor>0 && $this->record['peso_bruto']==0) {
                $this->record['peso_bruto'] = $lecturas['valor'];
                $this->time="";

                $lecturas->update([
                    'valor' => 0
                ]);
            }

            if($lecturas->valor>0 && $this->selectId>0 && $this->record['peso_tara']==0){
                $this->record['peso_tara'] = $lecturas['valor']; 
                $this->record['peso_neto'] = $this->record['peso_bruto']-$this->record['peso_tara']; 
                $this->time="";

                $lecturas->update([
                    'valor' => 0
                ]);

            }

        }
        
        return view('livewire.vc-peso-compras');
    }

    public function togglePesoManual()
    {
        $this->pesoManual = ($this->pesoManual === 'N') ? 'Y' : 'N';
    }

    public function loadData()
    {
        //$this->addData();

        $peso = DB::connection('sqlsrv')
        ->table('inv.tbl_tm_pesobascula as b')
        ->join('SGI_Cxp_Catalogo as c','c.Codigo','=','b.CodProveedor')
        ->leftjoin('sgi_inv_haciendas as h','h.Id_Fila','=','b.CodHacienda')
        ->join('sgi_inv_choferes as ch','ch.Id_Fila','=','b.CodChofer')
        ->join('sgi_inv_vehiculos as v','v.Id_Fila','=','b.CodVehiculo')
        ->select('b.*','c.Nombre as proveedor','h.Nombre as hacienda','ch.Nombre as chofer','v.Nombre as vehiculo')
        ->where('b.Id_Fila',$this->selectId)
        ->first();

        $this->record['id'] = $peso->Id_Fila;
        $this->record['fecha'] = $this->fecha;
        $this->record['hora'] = $this->hora;
        $this->record['codigo'] = $peso->CodProveedor;
        $this->record['proveedor'] = $peso->proveedor;
        $this->record['hacienda_id'] = $peso->CodHacienda;
        $this->record['hacienda'] = $peso->hacienda;
        $this->record['chofer_id'] = $peso->CodChofer;
        $this->record['chofer'] = $peso->chofer;
        $this->record['vehiculo_id'] = $peso->CodVehiculo;
        $this->record['vehiculo'] = $peso->vehiculo;
        $this->record['placa'] = $peso->Placa;
        $this->record['peso_bruto'] = $peso->Peso_Ingreso;
        $this->record['peso_tara'] = $peso->Peso_Salida;
        $this->record['peso_neto'] = $peso->Peso_Neto;
        $this->record['neto_normal'] = $peso->Neto_Normal;
        $this->record['castigo'] = $peso->Castigo;
        $this->record['producto'] = 'Palma Aceitera';
        $this->record['variedad'] = $peso->variedad;
        $this->record['fechabruto'] = date('d M Y',strtotime($peso->Fecha_Ingreso)); 
        $this->record['horabruto'] =  date('h-iA',strtotime($peso->Hora_Ingreso));
        $this->record['muestreo'] = 0;
        $this->record['fruta_optima'] = $peso->fruta_optima;
        $this->record['precioFG'] = $peso->FPrecioGrande;
        $this->record['precioFM'] = $peso->FPrecioMediana;
        $this->record['precioFP'] = $peso->FPrecioPequeña;
        $this->record['precioPC'] = $peso->FPrecioPrimerCorte;

        if($peso->Peso_Neto>0){
            $this->record['fechatara'] = date('d M Y',strtotime($peso->Fecha_Salida));
            $this->record['horatara'] = date('h-iA',strtotime($peso->Hora_Salida));
        }else{
            $this->record['fechatara'] = date('d M Y',strtotime($this->fecha));
            $this->record['horatara'] = date('h-iA',strtotime($this->hora));
        }
        $this->record['diasemana'] = $this->diasem[date('D',strtotime($peso->Fecha_Salida))];

        if($this->record['peso_neto']>0){
            $this->time="";
            $this->fieldset="disabled";
        }

        if($this->record['peso_bruto']>0){
            $this->fieldset="disabled";
        }
        
        $hacienda = ($peso->hacienda ?? 'SN');

        $this->persona = DB::connection('sqlsrv')
        ->table('sgi_cxp_catalogo')
        ->where('codigo',$this->record['codigo'])
        ->first();

        $this->loadPagos();
    }

    public function addData()
    {
        $this->record=[];
        $this->record['fecha'] = $this->fecha;
        $this->record['hora'] = $this->hora;
        $this->record['codigo'] = '';
        $this->record['proveedor'] = '';
        $this->record['hacienda_id'] = 0;
        $this->record['hacienda'] = '';
        $this->record['chofer_id'] = 0;
        $this->record['chofer'] = '';
        $this->record['vehiculo_id'] = 0;
        $this->record['vehiculo'] = '';
        $this->record['placa'] = '';
        $this->record['peso_tara'] = 0;
        $this->record['peso_bruto'] = 0;
        $this->record['peso_neto'] = 0;
        $this->record['fechabruto'] = date('d M Y',strtotime($this->fecha));
        $this->record['horabruto'] = date('h-iA',strtotime($this->hora));
        $this->record['fechatara'] = date('d M Y',strtotime($this->fecha));
        $this->record['horatara'] = date('h-iA',strtotime($this->hora));
        $this->record['producto'] = 'Palma Aceitera';
        $this->record['variedad'] = 'GUINNENSIS';
        $this->record['diasemana'] = $this->diasem[date('D',strtotime($this->fecha))];
        $this->record['neto_normal'] = 0;
        $this->record['precioFG'] = 0;
        $this->record['precioFM'] = 0;
        $this->record['precioFP'] = 0;
        $this->record['precioPC'] = 0;
        $this->record['castigo'] = 0;
        $this->record['muestreo'] = 0;
        $this->record['fruta_optima'] = 0;
        //$this->time="wire:poll.5000ms";

        $this->fieldset="";
        $this->selectId=0;
        $this->pago=[];
    }

    public function createData()
    {
        if($this->pesoManual=="Y"){
            $this->registroManual();
            return;
        }

        $fecha = $this->fecha ? Carbon::parse($this->fecha)->format('Y-m-d') : null; // Fecha (date)
        $hora  = $this->hora  ? Carbon::parse($this->hora)->format('H:i:s') : null;  // Hora (time)
        $fechaRegistro = Carbon::now()->format('Y-m-d H:i'); // smalldatetime -> 'Y-m-d H:i:s' OK

        if($this->selectId==0){

            if (!isset($this->record['peso_bruto']) || $this->record['peso_bruto'] <= 0) {
                $this->addError('record.peso_bruto', 'El peso bruto debe ser mayor que 0.');
                return;
            }

            $data = [
                'Tipo'             => 'ING',
                'CodProveedor'     => $this->record['codigo'],           // revisar tipo columna (Codigo)
                'CodHacienda'      => (int) ($this->record['hacienda_id'] ?? 0),
                'CodChofer'        => (int) ($this->record['chofer_id'] ?? 0),
                'CodVehiculo'      => (int) ($this->record['vehiculo_id'] ?? 0),
                'Placa'            => trim($this->record['placa'] ?? ''),
                'Bascula'          => 1,
                'Fecha_Ingreso'    => $fecha,                            // DATE
                'Hora_Ingreso'     => $hora,                             // TIME
                'Peso_Ingreso'     => (float) ($this->record['peso_bruto'] ?? 0),
                'Peso_Salida'      => 0,
                'Peso_Neto'        => 0,
                'Castigo'          => 0,
                'Neto_Normal'      => 0,
                'FPrecioGrande'    => (float) ($this->record['precioFG'] ?? 0),
                'FPrecioMediana'   => (float) ($this->record['precioFM'] ?? 0),
                'FPrecioPequeña'   => (float) ($this->record['precioFP'] ?? 0),
                'FPrimerCorte'     => (float) ($this->record['precioPC'] ?? 0),
                'usuario_registro' => trim($this->config->usuario),
                'fecha_registro'   => null,                    // smalldatetime
                'Estado'           => 'C',
                'NumPago'          => 1,
                'Numcia'           => (int) ($this->config->sucursal ?? 0),
                'variedad'         => $this->record['variedad'] ?? null,
            ];

            $id = DB::connection('sqlsrv')->table('inv.tbl_tm_pesobascula')->insertGetId($data);

            //racimos
            $this->calculaPeso();
            
            foreach($this->racimos as $racimo){
                
                if (!isset($racimo['cantidad']) || (int)$racimo['cantidad'] === 0) {
                    continue;
                }
                $detalle[] = [
                    'numero'           => $id,
                    'Id_Sector'        => $racimo['codigo'],
                    'Cantidad'         => $racimo['cantidad'],
                    'PesoNeto'         => $racimo['pesoneto'],
                    'Fecha_Registro'   => null,
                    'Equipo_Registro'  => null,
                    'Usuario_Registro' => isset($this->config->usuario) ? trim($this->config->usuario) : null,
                ];

            }

            if (!empty($detalle)) {
                DB::connection('sqlsrv')->table('inv.tbl_tm_pesobascula_sector')->insert($detalle);
            }


        }else{

            if (!isset($this->record['peso_tara']) || $this->record['peso_tara'] <= 0) {
                $this->addError('record.peso_tara', 'El peso tara debe ser mayor que 0.');
                return;
            }

            $peso = DB::connection('sqlsrv')
            ->table('inv.tbl_tm_pesobascula as b')
            ->where('id_fila',$this->selectId)
            ->firts();

            $peso->update([
                'Fecha_Salida'=> $fecha,
                'Hora_Salida' => $hora,  
                'Peso_Salida' => (float) ($this->record['peso_tara'] ?? 0),
                'Peso_Neto' => (float) ($this->record['peso_neto'] ?? 0),
                'Neto_Normal' => (float) ($this->record['peso_neto'] ?? 0),
                'FPeso_Grande' => (float) ($this->record['peso_neto'] ?? 0),
                'FPrecio_Grande' => (float) ($this->record['precioFG'] ?? 0),
                'FPrecio_Mediana' => (float) ($this->record['precioFM'] ?? 0),
                'FPrecio_Pequeña' => (float) ($this->record['precioFP'] ?? 0),
                'FPrecio_PrimerCorte' => (float) ($this->record['precioPC'] ?? 0),
                'Estado' => 'P',
            ]);

            $this->dispatch('grabaCalificacion', id: $this->selectId);
        } 
        
        $this->dispatch('msg-grabar');

    }

    public function registroManual(){

        $this ->validate([
            'record.codigo' => 'required',
            'record.hacienda_id' => 'required',
            'record.chofer_id' => 'required',
            'record.vehiculo_id' => 'required',
            'record.placa' => 'required',
            'record.fechabruto' => 'required',
            'record.horabruto' => 'required',
            'record.fechatara' => 'required',
            'record.horatara' => 'required',
            'record.peso_bruto' => 'required',
            'record.peso_tara' => 'required',
            'record.peso_neto' => 'required',
            'record.variedad' => 'required',
        ]);

        $data = [
            'Tipo'             => 'ING',
            'CodProveedor'     => $this->record['codigo'],
            'CodHacienda'      => (int) ($this->record['hacienda_id'] ?? 0),
            'CodChofer'        => (int) ($this->record['chofer_id'] ?? 0),
            'CodVehiculo'      => (int) ($this->record['vehiculo_id'] ?? 0),
            'Placa'            => trim($this->record['placa'] ?? ''),
            'Bascula'          => 1,
            'Fecha_Ingreso'    => $this->record['fechabruto'],
            'Hora_Ingreso'     => $this->record['horabruto'],
            'Fecha_Salida'    => $this->record['fechatara'],
            'Hora_Salida'     => $this->record['horatara'],
            'Peso_Ingreso'     => (float) ($this->record['peso_bruto'] ?? 0),
            'Peso_Salida'      => (float) ($this->record['peso_tara'] ?? 0),
            'Peso_Neto'        => (float) ($this->record['peso_neto'] ?? 0),
            'Castigo'          => 0,
            'Neto_Normal'      => (float) ($this->record['peso_neto'] ?? 0),
            'FPesoGrande'     => (float) ($this->record['peso_neto'] ?? 0),
            'FPrecioGrande'   => (float) ($this->record['precioFG'] ?? 0),
            'FPrecioMediana'    => (float) ($this->record['precioFM'] ?? 0),
            'FPrecioPequeña'    => (float) ($this->record['precioFP'] ?? 0),
            'FPrecioPrimerCorte' => (float) ($this->record['precioPC'] ?? 0),
            'usuario_registro' => trim($this->config->usuario),
            'fecha_registro'   => null,                    // smalldatetime
            'Estado'           => 'P',
            'Proceso'          => 'M',
            'NumPago'          => 1,
            'Numcia'           => (int) ($this->config->sucursal ?? 0),
            'variedad'         => $this->record['variedad'] ?? null
        ];

        $this->selectId = DB::connection('sqlsrv')->table('inv.tbl_tm_pesobascula')->insertGetId($data);

        //racimos
        $this->calculaPeso();
        
        $detalle=[];
        foreach($this->racimos as $racimo){
            
            if (!isset($racimo['cantidad']) || (int)$racimo['cantidad'] === 0) {
                continue;
            }
            $detalle[] = [
                'numero'           => $this->selectId,
                'Id_Sector'        => $racimo['codigo'],
                'Cantidad'         => $racimo['cantidad'],
                'PesoNeto'         => $racimo['pesoneto'],
                'Fecha_Registro'   => null,
                'Equipo_Registro'  => null,
                'Usuario_Registro' => isset($this->config->usuario) ? trim($this->config->usuario) : null,
            ];

        }

        if (!empty($detalle)) {
            DB::connection('sqlsrv')->table('inv.tbl_tm_pesobascula_sector')->insert($detalle);
        }

        //Calificacion
        $this->dispatch('grabaCalificacion', id: $this->selectId);
        
        $this->dispatch('msg-grabar');
    }

    public function selectTab($tab)
    {
        $this->activeTab =[
            'T1' => "",
            'S1' => "",
            'T2' => "",
            'S2' => "",
            'T3' => "",
            'S3' => "",
        ];

        $this->activeTab['T'.$tab]="active";
        $this->activeTab['S'.$tab]="active show";

        if($tab==3){
            $this->dispatch('setPesoNeto', valor: $this->record['peso_neto'], precio: $this->record['precioFG']);
        }
    }

    public function requestRun()
    {
        $payload = [
            'sessionId' => auth()->user()->id,
            'sucursal'  => $this->config->sucursal,
            'tipo'      => ($this->config->oficina==1) ? 'CFM' : 'CFA',
            'puertog'   => $this->config->puertog
        ];

        if ($this->record['peso_neto']==0){
            $this->dispatch('run-bascula', $payload);
            $this->time="wire:poll.5000ms";
        }
       
    }

    public function runExecutable()
    {
        // Define la ruta completa a tu archivo .exe
        // Asegúrate de usar las barras invertidas correctamente escapadas en Windows
        $executablePath = 'C:\\Bascula\\bascula.exe';

        // Si necesitas pasar argumentos
        $sessionId = auth()->user()->id;
        $tipo = ($this->config->oficina==1) ? 'CFM' : 'CFA';

        $arguments = [$sessionId,$this->config->sucursal,$tipo,$this->config->puertog];
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

    #[On('loadChofer')]
    public function loadChofer($id)
    {
        $this->tblplacas = DB::connection('sqlsrv')
        ->table('sgi_inv_vehiculos')
        ->where('Chofer',$id)
        ->select('Id_Fila','Nombre','Placa')
        ->get();

        $this->record['chofer_id'] = $id;
    }

    #[On('loadProveedor')]
    public function loadProovedor($id)
    {
        
        $this->persona = DB::connection('sqlsrv')
        ->table('sgi_cxp_catalogo')
        ->where('id_fila',$id)
        ->first();

        $this->record['codigo'] = $this->persona->codigo;
        $this->loadPrecio();
    }
    
    #[On('loadHacienda')]
    public function loadHacienda($id)
    {   

        $hacienda = DB::connection('sqlsrv')
        ->table('sgi_inv_haciendas')
        ->where('id_fila',$id)
        ->first();

        $this->record['hacienda_id'] = $id;
        $this->record['hacienda'] = $hacienda->Nombre;
        
        //Carga Sectores
        $sectores = DB::connection('sqlsrv')
        ->table('Erp_Inv_Haciendas_Det as d')
        ->join('SGI_Inv_Haciendas as h','d.id_hacienda','=','h.id_fila')
        ->where('h.CodProveedor',$this->record['codigo'])
        ->where('d.hasproducidas','>',0)
        ->where('h.id_fila','=',$this->record['hacienda_id'])
        ->selectRaw('d.id_fila as Id_Sector,d.sector')
        ->orderBy('d.sector')
        ->get();

        $this->racimos=[];
        foreach ($sectores as $key => $sector){
            $this->racimos[$key] = [
                'codigo'       => $sector->Id_Sector,
                'detalle'      => trim($sector->sector),
                'cantidad'     => 0,
                'pesoneto'     => 0,
            ];
        }

        $this->loadPrecio();
    }

    public function getVehiculo($id){

        $placa = DB::connection('sqlsrv')
        ->table('sgi_inv_vehiculos')
        ->where('Id_Fila',$id)
        ->first();

        $this->record['vehiculo_id'] = $placa->Id_Fila;
        $this->record['vehiculo'] = $placa->Nombre;
        $this->record['placa'] = $placa->Placa;
                    
    }

    public function loadPrecio(){

        $grupo = $this->persona->TipoGrupoPrv;
        $periodo = date('Y',strtotime($this->record['fechabruto']));
        $fecha = $this->record['fechabruto'];

        $semana =  DB::connection('sqlsrv')
        ->table('dbo.erp_ban_calendario as a')
        ->where('a.fechainicio', '<=', $fecha)
        ->where('a.fechafin', '>=', $fecha)
        ->first()->Semana;

        $precio = DB::connection('sqlsrv')
            ->select("EXEC Erp_Inv_PrecioSemBascula ?, ?, ?, ?, ?", [
                $grupo,
                $semana,
                $periodo,
                $this->record['codigo'],
                $this->record['hacienda_id']
            ]);

        $this->record['precioFG'] = $precio[0]->PFruta1;
        $this->record['precioFM'] = $precio[0]->PFruta2;
        $this->record['precioFP'] = $precio[0]->PFruta3;
        $this->record['precioPC'] = $precio[0]->PFruta4;
    }

    
    public function loadPagos(){
        
        $this->pago=[];
        
        $pago = DB::connection('sqlsrv')
        ->table('SGI_Cxp_Ticket_Anticipos as a')
        ->join('sgi_cxp_deuda as d', 'd.id_fila', '=', 'a.Id_Deuda')
        ->join('SGI_Bco_Catalogo as b', function($join) {
            $join->on('b.codigo', '=', 'd.CtaBanco')
                ->whereRaw('b.Ejercicio = YEAR(d.Emision)');
        })
        ->where('a.IdTicket',$this->selectId)
        ->select(
            'd.id_fila',
            'b.nombre',
            'd.NumCheque',
            'd.Emision',
            'd.Fecha_Registro'
        )
        ->first();
        
        if($pago){
            $this->pago =[
                'documento' => $pago->id_fila,
                'banco' => $pago->nombre,
                'cheque' => $pago->NumCheque,
                'fecha' => date('d M Y',strtotime($pago->Emision)),
                'hora' => date('h-iA',strtotime($pago->Fecha_Registro)),
                'diasemana' => $this->diasem[date('D',strtotime($pago->Emision))],
            ];
        }

        
    }

    public function pesoNeto()
    {
        $pesoBruto = $this->record['peso_bruto'];
        $pesoTara = $this->record['peso_tara'];
        $this->record['peso_neto'] = $pesoBruto-$pesoTara;
        $this->record['neto_normal'] = $pesoBruto-$pesoTara;
    }

    public function calculaPeso()
    {
        $valor = array_sum(array_column($this->racimos,'cantidad'));
        foreach($this->racimos as $key => $racimo){
            if($racimo['cantidad']==0){
                continue;
            }
            $this->racimos[$key]['pesoneto'] = $this->record['peso_bruto']*($racimo['cantidad']/$valor);
        }
    }

    public function imprimir($id)
    {
        // Redirige a la ruta que muestra el PDF en el navegador (stream)
        return redirect()->route('ticketCompra.pdf', $id);
    }

    public function imprimirConAutoPrint($id)
    {
        // Redirige a la ruta que abre el iframe y ejecuta print()
        return redirect()->route('ticketCompra.pdf.print', $id);
    }

    public function descargar($id)
    {
        return redirect()->route('ticketCompra.pdf.download', $id);
    }

}
