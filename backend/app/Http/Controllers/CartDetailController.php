<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\CartDetail;
use App\Models\Productos;
use Carbon\Carbon;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
        $idCarrito=null;
        $cartUser = Cart::where([
            ["id_usuario", $request->user()->id],
            ["estado", 'PEN'],
        ])->get();

        if (count($cartUser) < 1) {

            $cart             = new Cart(
                [
                    'fecha_orden' => Carbon::now(),
                    'estado' => "PEN",
                    'total' => 0,
                    'id_usuario' => $request->user()->id
                ]
            );
            $cart->save();
            $idCarrito=$cart->id;
       }
       else{
        $idCarrito=$cartUser[0]->id;
       }

        $producto                = Productos::select("id","stock")->where([
            ["id", $request->id_producto],
        ])
            //->where("stock",">=",$request->cantidad)
            ->first();

        if (is_object($producto)) {
            if (($producto->stock) >= $request->cantidad) {
                $data = [
                    'code' => 200,
                    'producto' => $producto,
                    'message' => "Producto agregado al carrito " . $idCarrito,

                ];

                //Creadndo detalle
                $cartDetail = new CartDetail(
                    [
                        'id_cart' => $idCarrito,
                        'id_producto' => $producto->id,
                        'cantidad' => $request->cantidad
                    ]
                );
                $cartDetail->save();

                return response()->json($data, $data['code']);
            } elseif (($producto->stock) > 0 && ($producto->stock) < $request->cantidad) {
                $data = [
                    'code' => 400,
                    'producto' => $producto,
                    'message' => "No hay existencias suficientes para la cantidad"
                ];
            } else {
                $data = [
                    'code' => 400,
                    'producto' => $producto,
                    'message' => "No hay existencias",

                ];
            }
        } else {
            $data = [
                'code' => 404,
                'message' => "No existe el producto",

            ];
        }
        return response()->json($data, $data['code']);

        /*
        $cartDetail             = new CartDetail();
        $cartDetail->id_producto = $request->id_producto;

        $cartDetail->cantidad   = $request->cantidad;
        $cartDetail->save();



        $producto->stock    = $producto->stock - $request->cantidad;
        $producto->save();


        $notification = "El producto se agregó exitosamente";
        return back()->with(compact('notification'));*/
    }

    public function destroy(Request $request)
    {

        $cartDetail             = CartDetail::find($request->cart_detail_id);
        # Se debe comprobar si el id del carrito de compras que se quiere eliminar
        # es de el usuario autenticado.. de lo contrario es una vulnerabilidad
        if ($cartDetail->cart_id == auth()->user()->cart->id)
            $cartDetail->delete();

        $notification = "¡El producto se ha eliminado del carrito correctamente!.";
        return back()->with(compact('notification'));
    }
}
