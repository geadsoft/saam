<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tcNovedades extends Model
{
   // use HasFactory;
   protected $table = 'tc_novedades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fecha',
        'titulo',
        'descripcion',
        'usuario',
        'asignado',
        'fechaini',
        'fechafin',
        'estado',
        'prioridad',
        'tipo',
        ];
}
