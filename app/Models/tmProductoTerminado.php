<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tmProductoTerminado extends Model
{
    protected $table = 'tm_producto_terminados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fecha' ,
        'tanque' ,
        'producto' ,
        'tonelada' ,
        'ubicacion' ,
        'acidez' ,
        'humedad' ,
        'impureza' ,
        'color' ,
        'peroxido' ,
        'referencia',
        'usuario',
    ];
}
