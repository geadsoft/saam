<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TdMovimientosVacaciones;
use App\Models\TmPersonas;

class TdSolicitudVacaciones extends Model
{
    protected $table = 'td_solicitud_vacaciones';
    protected $primaryKey = "id";
    protected $fillable = [
        'persona_id',
        'fecha',
        'fecha_empieza',
        'fecha_termina',
        'observacion',
        'dias',
        'usuario',
        'estado',
    ];

    public function movimientos()
    {
        return $this->hasMany(TdMovimientosVacaciones::class, 'solicitud_vacacion_id');
    }

    public function persona()
    {
        return $this->belongsTo(TmPersonas::class, 'persona_id');
    }

}
