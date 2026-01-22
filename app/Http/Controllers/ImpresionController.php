<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ImpresionController extends Controller
{
    public function pesoCompra_verPdf($id)
    {

        $peso = DB::connection('sqlsrv')
        ->table('inv.tbl_tm_pesobascula as b')
        ->join('SGI_Cxp_Catalogo as c','c.Codigo','=','b.CodProveedor')
        ->leftjoin('sgi_inv_haciendas as h','h.Id_Fila','=','b.CodHacienda')
        ->join('sgi_inv_choferes as ch','ch.Id_Fila','=','b.CodChofer')
        ->join('sgi_inv_vehiculos as v','v.Id_Fila','=','b.CodVehiculo')
        ->select('b.*','c.Nombre as proveedor','h.Nombre as hacienda','ch.Nombre as chofer','v.Nombre as vehiculo')
        ->where('b.Id_Fila',$id)
        ->first();

        $racimos=DB::connection('sqlsrv') 
        ->table('inv.Tbl_Tm_PesoBascula_Sector as s')
        ->join('Erp_Inv_Haciendas_Det as d','s.Id_Sector','=','d.id_fila')
        ->where('s.numero',$id)
        ->select("d.id_fila","d.sector","s.cantidad", "s.pesoneto")
        ->get()->toArray();

        
        if ($peso->Peso_Neto>0){
            $calificacion = DB::connection('sqlsrv')
            ->table('inv.Tbl_Tm_PesoBascula_Califica as b')
            ->join('SGI_CXP_Castigo_Proveedores as c','c.id_fila','=','b.id_calificacion')
            ->where('b.Id_PesoBascula',$id)
            ->get();
        }else{
             $calificacion = DB::connection('sqlsrv')
            ->table('SGI_CXP_Castigo_Proveedores as b')
            ->whereRaw("CHARINDEX('Fruta', nombre) = 0")
            ->selectRaw("Nombre, 0 as Racimos, 0 as Porcentaje_Calificacion")
            ->get();
        }

        $pdf = PDF::loadView('bascula.print_pesocompra', compact('peso','calificacion','racimos'))->setPaper('a4', 'portrait');

        // Mostrar en navegador (stream)
        return $pdf->stream("factura-{$peso->Id_Fila}.pdf");
    }

    public function pesoCompra_descargarPdf($id)
    {
        $peso = DB::connection('sqlsrv')
        ->table('inv.tbl_tm_pesobascula as b')
        ->join('SGI_Cxp_Catalogo as c','c.Codigo','=','b.CodProveedor')
        ->leftjoin('sgi_inv_haciendas as h','h.Id_Fila','=','b.CodHacienda')
        ->join('sgi_inv_choferes as ch','ch.Id_Fila','=','b.CodChofer')
        ->join('sgi_inv_vehiculos as v','v.Id_Fila','=','b.CodVehiculo')
        ->select('b.*','c.Nombre as proveedor','h.Nombre as hacienda','ch.Nombre as chofer','v.Nombre as vehiculo')
        ->where('b.Id_Fila',$id)
        ->first();

        $racimos=[];

        $calificacion = DB::connection('sqlsrv')
        ->table('inv.Tbl_Tm_PesoBascula_Califica as b')
        ->join('SGI_CXP_Castigo_Proveedores as c','c.id_fila','=','b.id_calificacion')
        ->where('b.Id_PesoBascula',$id)
        ->get();

        $pdf = Pdf::loadView('bascula.print_pesocompra', compact('peso','racimos','calificacion'))->setPaper('a4', 'portrait');

        // Forzar descarga
        return $pdf->download("factura-{$peso->Id_Fila}.pdf");
    }

    public function pesoCompra_PdfAutoPrint($id)
    {
         $peso = DB::connection('sqlsrv')
        ->table('inv.tbl_tm_pesobascula as b')
        ->join('SGI_Cxp_Catalogo as c','c.Codigo','=','b.CodProveedor')
        ->leftjoin('sgi_inv_haciendas as h','h.Id_Fila','=','b.CodHacienda')
        ->join('sgi_inv_choferes as ch','ch.Id_Fila','=','b.CodChofer')
        ->join('sgi_inv_vehiculos as v','v.Id_Fila','=','b.CodVehiculo')
        ->select('b.*','c.Nombre as proveedor','h.Nombre as hacienda','ch.Nombre as chofer','v.Nombre as vehiculo')
        ->where('b.Id_Fila',$id)
        ->first();

        // Generamos HTML simple que inyecta el PDF en un <iframe> y auto-imprime al cargar
        $pdf = Pdf::loadView('bascula.print_pesocompra', compact('peso'))->setPaper('a4', 'portrait');
        $binary = $pdf->output(); // bytes del PDF
        $base64 = base64_encode($binary);

        // Retornamos HTML que abre el PDF embebido y ejecuta print()
        return response()->view('bascula.autoprint_pesocompra', compact('base64', 'peso'));
    }

    public function certificado_verPdf($tipo, $id)
    {
        if($tipo!="99"){
            
            $detalle = DB::connection('sqlsrv')
            ->table('Erp_Bas_Certificados as c')
            ->join('erp_inv_rubroscalidad as r','r.id_fila','=','c.rubrocalidad_id')
            ->where('c.peso_id',$id)
            ->where('c.venta',1)
            ->select('r.id_fila','r.nombre','c.valor','r.minimo','r.maximo','r.metodo', 'c.lote',
            'c.fecha_produccion','r.etiqueta','c.etiqueta as muestra','c.empaque','user_produccion','user_calidad',
            'r.producto','tanque')
            ->get();
        
        }else{

            $detalle = DB::connection('sqlsrv')
            ->table('Erp_Bas_Certificados as c')
            ->join('erp_inv_rubroscalidad as r','r.id_fila','=','c.rubrocalidad_id')
            ->where('c.peso_id',$id)
            ->where('c.abastecimiento',1)
            ->select('r.id_fila','r.nombre','c.valor','r.minimo','r.maximo','r.metodo', 'c.lote',
            'c.fecha_produccion','r.etiqueta','c.etiqueta as muestra','c.empaque','user_produccion','user_calidad',
            'r.producto','tanque')
            ->get();

        }


        $certificado = $detalle->first();
        $etiqueta = $detalle->filter(function($item){
            return trim($item->etiqueta) !== '' && !is_null($item->etiqueta);
        });

        $lncol = 0;
        foreach ($etiqueta as $key => $data){

            if ($key % 2 == 0) {
                $lncol = $lncol+1; 
                $muestra[$lncol]['col1'] = $data->etiqueta;
                $muestra[$lncol]['val1'] = $data->valor;
            }else{
                $muestra[$lncol]['col2'] = $data->etiqueta;
                $muestra[$lncol]['val2'] = $data->valor;
            };

            $cpo[$data->etiqueta]=$data->valor;
        };  

        $record = DB::connection('sqlsrv')->table('bascula_ventas as v')
        ->where('Id_fila',$id)
        ->where('TipoEgr',$tipo)
        ->first();

        $tanquero = $record->PlacaTanquero;

        $arrext=[
            '50201001',
            '50201003',
            '50201004',
            '704001005',
            '30102004'
        ];


        
        if (in_array($certificado->producto, $arrext)){

            if($certificado->producto=='30102004'){
                $cpo['PKO'] = 'X';
                $cpo['CPO'] = ' ';
            }else{
                $cpo['PKO'] = ' ';
                $cpo['CPO'] = 'X';
            }

            $pdf = PDF::loadView('bascula.print_certificados_ext', compact('record','detalle','certificado','cpo'))->setPaper('a4', 'portrait');
        }else{
            $pdf = PDF::loadView('bascula.print_certificados_ref', compact('record','detalle','certificado','muestra','tanquero'))->setPaper('a4', 'portrait');
        }
        
        // Mostrar en navegador (stream)
        return $pdf->stream("certificado-{$record->Documento}.pdf");

    }
}
