<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = ['fecha_contrato','descripcion','modalidad','id_cliente','contrado_doc','status','fecha_finaliza','fecha_recurrente','fechaf_recurrente','precio','id_usuario','created_at'];
}
