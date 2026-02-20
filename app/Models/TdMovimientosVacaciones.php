<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TdPeriodoVacaciones;
use App\Models\TdSolicitudVacaciones;

class TdMovimientosVacaciones extends Model
{
    protected $table = 'td_movimientos_vacaciones';
    protected $primaryKey = "id";
    protected $fillable = [
        'solicitud_vacacion_id',
        'periodo_vacacion_id',
        'dias_descontados',
        'fecha'
    ];

    public function periodo()
    {
        return $this->belongsTo(TdPeriodoVacaciones::class, 'periodo_vacacion_id');
    }

    public function solicitud()
    {
        return $this->belongsTo(TdSolicitudVacaciones::class, 'solicitud_vacacion_id');
    }
}
