<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmHorarios extends Model
{
    //use HasFactory;
    protected $table = 'tm_horarios';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'entrada',
        'salida',
        'ini_entrada',
        'fin_entrada',
        'ini_salida',
        'fin_salida',
        'nocturno',
        'jornada',
        'tolerancia',
        'ini_descanso',
        'fin_descanso',
        'descanso',
        'estado',
    ];

}
