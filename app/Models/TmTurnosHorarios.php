<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmTurnosHorarios extends Model
{
    //use HasFactory;
    protected $table = 'tm_turnos_horarios';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'area_id',
        'horario_id',
        'sup_25_aplica',
        'sup_25_porcentaje',
        'sup_50_aplica',
        'sup_50_porcentaje',
        'extra_aplica',
        'extra_porcentaje',
        'dias_extra',
        'estado',        
    ];
    
    public function area(){
        return $this->belongsTo('App\Models\TmArea');
    }

    public function horario(){
        return $this->belongsTo('App\Models\TmHorarios');
    }
}
