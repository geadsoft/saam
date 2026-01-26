<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdHorasExtras extends Model
{
    //use HasFactory;
    protected $table = 'td_horas_extras';
    protected $primaryKey = "id";
    protected $fillable = [
        'periodorol_id',
        'persona_id',
        'fecha',
        'horas',
        'extra25',
        'monto25',
        'extra50',
        'monto50',
        'extra100',
        'monto100',
        'total',
        'usuario',
    ];

    public function persona(){
        return $this->belongsTo('App\Models\TmPersonas');
    }


}
