<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmCuentasContables extends Model
{
    protected $table = 'tm_cuentas_contables';
    protected $primaryKey = "id";
    protected $fillable = [
        'tiporol_id',
        'remuneracion',
        'rubro_id',
        'rubro_pago',
        'cuenta',
        'descripcion',
        'tipo',
        'comprobante',
        'ccosto',
        'gastodeducible',
        'usuario',
        'estado',
    ];

    public function rubro(){
        return $this->belongsTo('App\Models\TmRubrosrol');
    }
}
