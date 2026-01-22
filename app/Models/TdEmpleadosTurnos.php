<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdEmpleadosTurnos extends Model
{
    
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    //use HasFactory;
    protected $table = 'td_empleados_turnos';
    protected $primaryKey = "id";
    protected $fillable = [
        'persona_id',
        'turno_id',
        'fecha_inicio',
        'fecha_fin',
        'horas_extras',
        'usuario',
        'estado',
    ];

    public function persona()
    {
        return $this->belongsTo(TmPersonas::class, 'persona_id');
    }
}
