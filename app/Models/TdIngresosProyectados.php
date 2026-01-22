<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdIngresosProyectados extends Model
{
    //use HasFactory;
    protected $table = 'td_ingresos_proyectados';
    protected $primaryKey = "id";
    protected $fillable = [
        'persona_id',
        'rubro_id',
        'linea',
        'valor_mes',
        'valor_dia',
        'usuario',
        'estado',
    ];

    public function persona(){
        return $this->belongsTo('App\Models\TmPersonas');
    }

    public function rubro(){
        return $this->belongsTo('App\Models\TmRubrosrol');
    }

}
