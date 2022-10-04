<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Productos::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'productos' => $productos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params_array = [
            'id' => $request->id,
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $request->imagen
        ];
        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'Nos se han enviado los datos para almacenar'
        ];

        if (!empty($params_array)) {
            $validate = \Validator::make($params_array, [
                'id' => 'required',
                'categoria_id' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required',
                'stock' => 'required',
                'imagen' => 'required'
            ]);
            if ($validate->fails()) {
                $data = [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'El registro no se ha guardado',
                    'errors' => $validate->errors()
                ];
            }else{
                $producto = Producto::create($params_array);

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'producto' => $producto
                ];
            }
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::where('id', $id)->get();

        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'No se han encontrados datos.'
        ];

        if (is_object($producto)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $producto
            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params_array = [
            'id' => $request->id,
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $request->imagen
        ];
        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'Nos se han enviado los datos para almacenar'
        ];

        if (!empty($params_array)) {
            $validate = \Validator::make($params_array, [
                'id' => 'required',
                'categoria_id' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required',
                'stock' => 'required',
                'imagen' => 'required'
            ]);

            if ($validate->fails()) {
                $data = [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'El registro no se ha modificado',
                    'errors' => $validate->errors()
                ];
            }else{
                $producto = Producto::where('id',$id)->update($params_array);

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'producto' => $producto
                ];

            }
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::where('id', $id)->get();

        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'No se han encontrados datos.',
        ];

        if (!empty($producto)) {

            $producto->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $producto,
            ];
        }
        return response()->json($data, $data['code']);
    }
}
