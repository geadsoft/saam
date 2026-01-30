<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdMovimientosVacaciones extends Model
{
    protected $table = 'td_movimientos_vacaciones';
    protected $primaryKey = "id";
    protected $fillable = [
        'solicitud_vacacion_id',
        'periodo_vacacion_id',
        'dias_descontados',
        'fecha',
        'usuario',
    ];
}
