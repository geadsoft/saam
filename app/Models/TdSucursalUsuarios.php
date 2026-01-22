<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdSucursalUsuarios extends Model
{
    //use HasFactory;
    protected $table = 'td_sucursal_usuarios';
    protected $primaryKey = "id";
    protected $fillable = [
        'usuario_id',
        'usuario',
    ];
}
