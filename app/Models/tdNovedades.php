<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tdNovedades extends Model
{
    //use HasFactory;
    protected $table = 'td_novedades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'novedad_id',
        'fecha',
        'enviado',
        'observacion',
    ];
}
