<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagoservicio extends Model
{
    use HasFactory;
    protected $fillable = ['formapago','precio','titular','ntarjeta','vencimiento','seguridad','comprobante','id_servicio','id_cliente','id_usuario'];
}
