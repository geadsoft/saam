<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdComprobanteRol extends Model
{
    //use HasFactory;
    protected $table = 'td_comprobante_rols';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'comprobante_id',
        'tipo',
        'mes',
        'periodo',
        'fecha',
        'cuenta',
        'detalle',
        'naturaleza',
        'valor',
        'estado',
        'deducible',
        'ccosto',
        'usuario',    
    ];

}
