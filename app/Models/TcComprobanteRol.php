<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcComprobanteRol extends Model
{
    //use HasFactory;
    protected $table = 'tc_comprobante_rols';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'rolpago_id',
        'comprobante',
        'mes',
        'periodo',
        'tipo',
        'documento',
        'fecha',
        'codigo',
        'observacion',
        'total',
        'debito',
        'credito',
        'total',
        'estado',
    ];

}
