<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturaCom extends Model
{   
    protected $table = 'lectura_com';
    protected $primaryKey = "id";
    protected $fillable = [
        'usuario_id',
        'sucursal',
        'proceso',
        'valor',
    ];
}
