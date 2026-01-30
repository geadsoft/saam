<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdPeriodoVacaciones extends Model
{
    protected $table = 'td_periodo_vacaciones';
    protected $primaryKey = "id";
    protected $fillable = [
        'persona_id',
        'periodo',
        'dias_generados',
        'dias_usados',
    ];
}
