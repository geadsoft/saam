<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContabilidadController;
use App\Http\Controllers\ImpresionController;
use App\Livewire\VcRegistrarPagos;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/bascula/compras',[App\Http\Controllers\BasculaController::class, 'compras'])->name('compras');
Route::get('/bascula/ventas',[App\Http\Controllers\BasculaController::class, 'ventas'])->name('ventas');
Route::get('/lectura',[App\Http\Controllers\BasculaController::class, 'lectura'])->name('lectura');
Route::get('/administracion/gestion',[App\Http\Controllers\AdministracionController::class, 'gestion'])->name('gestion');
Route::get('/inventario/producto-terminado',[App\Http\Controllers\InventarioController::class, 'inventario'])->name('inventario');

Route::get('/setting/generalities',[App\Http\Controllers\RecursosHumanosController::class, 'general'])->name('general');
Route::get('/setting/empresa',[App\Http\Controllers\RecursosHumanosController::class, 'empresa'])->name('empresa');
Route::get('/setting/enlace-contables',[App\Http\Controllers\RecursosHumanosController::class, 'enlace_contables'])->name('enlace_contables');

Route::get('/form/areas',[App\Http\Controllers\RecursosHumanosController::class, 'areas'])->name('areas');
Route::get('/form/departament',[App\Http\Controllers\RecursosHumanosController::class, 'departamentos'])->name('departamentos');
Route::get('/form/charges',[App\Http\Controllers\RecursosHumanosController::class, 'cargos'])->name('cargos');
Route::get('/form/periods',[App\Http\Controllers\RecursosHumanosController::class, 'periodos'])->name('periodos');
Route::get('/form/rubros',[App\Http\Controllers\RecursosHumanosController::class, 'rubros'])->name('rubros');
Route::get('/form/rubros-add',[App\Http\Controllers\RecursosHumanosController::class, 'agregar_rubros'])->name('agregar_rubros');
Route::get('/form/rubros-edit/{id}',[App\Http\Controllers\RecursosHumanosController::class, 'editar_rubros'])->name('editar_rubros');
Route::get('/rrhh/horarios',[App\Http\Controllers\RecursosHumanosController::class, 'horarios'])->name('horarios');
Route::get('/rrhh/turnos',[App\Http\Controllers\RecursosHumanosController::class, 'turnos'])->name('turnos');
Route::get('/rrhh/asignar-turnos',[App\Http\Controllers\RecursosHumanosController::class, 'asignarturnos'])->name('asignarturnos');

Route::get('/payroll/panel',[App\Http\Controllers\RecursosHumanosController::class, 'panel'])->name('panel');
Route::get('/payroll/tiposrol',[App\Http\Controllers\RecursosHumanosController::class, 'tipos_rol'])->name('tipos_rol');
Route::get('/payroll/assign-rubros',[App\Http\Controllers\RecursosHumanosController::class, 'asignar_rubros'])->name('asignar_rubros');
Route::get('/payroll/planilla',[App\Http\Controllers\RecursosHumanosController::class, 'planillas'])->name('planillas');
Route::get('/payroll/rolpago',[App\Http\Controllers\RecursosHumanosController::class, 'rolpago'])->name('rolpago');
Route::get('/payroll/prestamos',[App\Http\Controllers\RecursosHumanosController::class, 'prestamos'])->name('prestamos');
Route::get('/payroll/prestamos/{id}',[App\Http\Controllers\RecursosHumanosController::class, 'editar_prestamos'])->name('editar_prestamos');
Route::get('/payroll/registrar-pagos/{id}',[App\Http\Controllers\RecursosHumanosController::class, 'agregar_rolpago'])->name('agregar_rolpago');
Route::get('/payroll/registrar-pagos/edit/{id}',[App\Http\Controllers\RecursosHumanosController::class, 'editar_rolpago'])->name('editar_rolpago');
Route::get('/payroll/nominas',[App\Http\Controllers\RecursosHumanosController::class, 'nomina'])->name('nomina');
Route::get('/rrhh/marcaciones',[App\Http\Controllers\RecursosHumanosController::class, 'marcaciones'])->name('marcaciones');
Route::get('/payroll/comprobante/{id},{tipo}',[App\Http\Controllers\RecursosHumanosController::class, 'comprobante'])->name('comprobante');
Route::get('/payroll/horas-extras',[App\Http\Controllers\RecursosHumanosController::class, 'hextras'])->name('hextras');

Route::get('/bascula/panel',[App\Http\Controllers\BasculaController::class, 'panel'])->name('panel');
Route::get('/bascula/flujo-negocio',[App\Http\Controllers\BasculaController::class, 'panel_negocio'])->name('panel_negocio');
Route::get('/bascula/compras',[App\Http\Controllers\BasculaController::class, 'compras'])->name('compras');
Route::get('/bascula/ventas',[App\Http\Controllers\BasculaController::class, 'ventas'])->name('ventas');
Route::get('/bascula/tanque',[App\Http\Controllers\BasculaController::class, 'tanque'])->name('tanque');
Route::get('/bascula/abastecimiento',[App\Http\Controllers\BasculaController::class, 'abastecimiento'])->name('abastecimiento');
Route::get('/bascula-compra/peso-bruto',[App\Http\Controllers\BasculaController::class, 'compra_bruto'])->name('compra_bruto');
Route::get('/bascula-compra/peso-tara/{id}',[App\Http\Controllers\BasculaController::class, 'compra_tara'])->name('compra_tara');
Route::get('/bascula/certificados',[App\Http\Controllers\BasculaController::class, 'certificados'])->name('certificados');
Route::get('/bascula/certificado-calidad/{tipo},{id}',[App\Http\Controllers\BasculaController::class, 'cert_calidad'])->name('cert_calidad');
Route::get('/bascula/pcc',[App\Http\Controllers\BasculaController::class, 'pcc'])->name('pcc');

Route::get('/contabilidad/ccosto_cuentas',[App\Http\Controllers\ContabilidadController::class, 'ccosto_ctas'])->name('ccosto_ctas');
Route::get('/contabilidad/auxiliar_contable/{periodo}/{cuenta}/{ccosto}',[App\Http\Controllers\ContabilidadController::class, 'auxiliar'])->name('ctas.auxiliar');
Route::get('/contabilidad/catalogo_cuentas',[App\Http\Controllers\ContabilidadController::class, 'plan_cuentas'])->name('plan_cuentas');
//Route::get('/contabilidad/auxiliar_contable', [ContabilidadController::class, 'auxiliar'])->name('auxiliar');

Route::get('/file/staff',[App\Http\Controllers\RecursosHumanosController::class, 'personas'])->name('personas');
Route::get('/file/staff-add',[App\Http\Controllers\RecursosHumanosController::class, 'agregar_personas'])->name('agregar_personas');
Route::get('/file/staff-edit/{id}',[App\Http\Controllers\RecursosHumanosController::class, 'editar_personas'])->name('editar_personas');
Route::get('/file/contracts',[App\Http\Controllers\RecursosHumanosController::class, 'contratos'])->name('contratos');

Route::get('/calendario',[App\Http\Controllers\RecursosHumanosController::class, 'calendario'])->name('calendario');

Route::get('/download-pdf/nomina/{data}',[VcRegistrarPagos::class, 'downloadPDF']);
Route::get('/download-pdf/pagorol/{data}',[VcRegistrarPagos::class, 'downloadRolPDF']);
Route::get('/download-pdf/pagos/{data}',[VcRegistrarPagos::class, 'downloadPagosPDF'])->name('pagos.pdf');
Route::get('/peso_compra/pdf/{id}', [ImpresionController::class, 'pesoCompra_verPdf'])->name('ticketCompra.pdf');
Route::get('/peso_compra/pdf/imprimir/{id}', [ImpresionController::class, 'pesoCompra_PdfAutoPrint'])->name('ticketCompra.pdf.print');
Route::get('/peso_compra/pdf/descargar/{id}', [ImpresionController::class, 'pesoCompra_descargarPdf'])->name('ticketCompra.pdf.download');
Route::get('/certificado/pdf/{tipo},{id}', [ImpresionController::class, 'certificado_verPdf'])->name('Certificado.pdf');

Route::post('import-data-excel',[VcImportExcel::class, 'import'])->name('import.excel');
