<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'categorias' => $categorias
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
            'nombre' => $request->nombre,
        ];
        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'Nos se han enviado los datos para almacenar'
        ];

        if (!empty($params_array)) {
            $validate = \Validator::make($params_array, [
                'id' => 'required',
                'nombre' => 'required'
            ]);
            if ($validate->fails()) {
                $data = [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'El registro no se ha guardado',
                    'errors' => $validate->errors()
                ];
            }else{
                $categoria = Categoria::create($params_array);

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'categoria' => $categoria
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
        $categoria = Categoria::where('id', $id)->get();

        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'No se han encontrados datos.'
        ];

        if (is_object($categoria)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'categoria' => $categoria
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
            'nombre' => $request->nombre
        ];
        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'Nos se han enviado los datos para almacenar'
        ];

        if (!empty($params_array)) {
            $validate = \Validator::make($params_array, [
                'id' => 'required',
                'nombre' => 'required'
            ]);

            if ($validate->fails()) {
                $data = [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'El registro no se ha modificado',
                    'errors' => $validate->errors()
                ];
            }else{
                $categoria = Categoria::where('id',$id)->update($params_array);

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'categoria' => $categoria
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
        $categoria = Categoria::where('id', $id)->get();

        $data = [
            'code' => 404,
            'status' => 'error',
            'message' => 'No se han encontrados datos.',
        ];

        if (!empty($categoria)) {

            $categoria->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'categoria' => $categoria,
            ];
        }
        return response()->json($data, $data['code']);
    }
}
