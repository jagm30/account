<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['apaterno','amaterno','nombre','email','telefono','direccion','ciudad','estado','status'];

    








}
