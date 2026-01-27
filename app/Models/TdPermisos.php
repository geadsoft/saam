<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdPermisos extends Model
{
    //use HasFactory;
    protected $table = 'td_permisos';
    protected $primaryKey = "id";
    protected $fillable = [
        'persona_id',
        'fecha',
        'referencia',
        'remuneracion',
        'fecha_empieza',
        'fecha_termina',
        'observacion',
        'tiempo',
        'usuario',
        'estado',
    ];

    public function persona(){
        return $this->belongsTo('App\Models\TmPersonas');
    }
}
