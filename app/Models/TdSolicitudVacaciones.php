<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
