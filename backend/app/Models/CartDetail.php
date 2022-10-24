<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_detail';
    protected $fillable = ['id','id_cart','id_producto','cantidad'];

    public function getProduct(){
        #Un producto puede aparecer en muchos carritos de compras
        return $this->belongsTo(Productos::class);
    }
}
