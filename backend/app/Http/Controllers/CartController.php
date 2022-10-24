<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function update(Request $req){
        #dd($req);

        $currentCart                = auth()->user()->cart;
        # Recorremos cada producto del carrito para obtener la cantidad total

        $total = 0;
        foreach (auth()->user()->cart->details as $detail)
          $total= $total + $detail->product->precio * $detail->cantidad;


        $currentCart->codigo          = $this->generateCode(8);
        $currentCart->total         = $total;
        $currentCart->fecha_orden    = date('d-m-Y');
        $currentCart->estado        = "Pendiente";
        $currentCart->save();

        $notification= "Tu pedido se ha registrado correctamente. Te contactaremos via email a la brevedad...";
        return back()->with(compact('notification'));
    }

    public function updateestado(Request $req){

        $order = auth()->user()->orderDetails;

        # validar
        $order->estado = $req->estado;

        #Al cambiar a finalizado, la fecha de llegada se coloca como actual
        if($req->estado == "Finalizado")
            $order->arrived_date = date('d-m-Y');
        $order->save();

        $notification           = "¡El estado del producto ha cambiado!";
        return back()->with(compact('notification'));
    }

    public function destroy(Request $req){

        #$order = auth()->user()->cart;
        #$order = Cart::find($req->order_id);
        $order = auth()->user()->orderDetails;

        #if($cartDetail->cart_id == auth()->user()->cart->id)
        $order->delete();

        $notification = "¡El pedido seleccionado se ha eliminado correctamente!.";
        return back()->with(compact('notification'));

    }

    private function generateCode($len){

        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
        $cadena = ""; //variable para almacenar la cadena generada
        for($i=0;$i<$len;$i++)
            $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres
        entre el rango 0 a Numero de letras que tiene la cadena */
        return $cadena;

    }
}
