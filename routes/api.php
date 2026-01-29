<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LecturaCom;
use App\Http\Controllers\BiometricoController;
use App\Http\Controllers\TalentoHumanoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/dato-com', function (Request $request) {
    
    // Leer los datos enviados desde FoxPro
    $sessionId  = $request->input('session');
    $sucursal = $request->input('sucursal');
    $proceso  = $request->input('proceso');
    $valor    = $request->input('valor');

    LecturaCom::updateOrCreate(
        [
            'usuario_id' => $sessionId,
            'sucursal'   => $sucursal,
            'proceso'    => $proceso,
        ],
        [
            'valor' => $valor,
        ]
    );

});

Route::middleware('auth:sanctum')
    ->post('/biometrico/marcaciones', [BiometricoController::class, 'store']);

Route::post('/biometrico/push', [BiometricoController::class, 'receivePush']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/marcaciones', [TalentoHumanoController::class, 'loadmarcaciones']);
