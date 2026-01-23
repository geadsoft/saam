<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdTimbres extends Model
{
    //use HasFactory;
    protected $table = 'td_timbres';
    protected $primaryKey = "id";
    protected $fillable = [
        'codigo',
        'fecha_hora',
        'fecha',
        'hora',
        'funcion',
        'estado',
    ];


}
