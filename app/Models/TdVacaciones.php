<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdVacaciones extends Model
{
    protected $table = 'td_vacaciones';
    protected $primaryKey = "id";
    protected $fillable = [
        'persona_id',
        'fecha',
        'fecha_empieza',
        'fecha_termina',
        'observacion',
        'tiempo',
        'usuario',
        'estado',
    ];

}
