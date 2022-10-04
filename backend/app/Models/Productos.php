<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $fillable = ['id','categoria_id','nombre','descripcion','precio','stock','imagen'];
}

