<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\categoria;
use App\Models\Insumo;
use App\Models\User;
use App\Models\DetalleProducto;
use App\Http\Requests\productos\StoreRequest;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumos = Insumo::all();
        $productos = Productos::all();
        $detalleProducto = detalleProducto::all();

        

        foreach ($productos as $producto) {
            $insumo = $producto->insumo;
        }
       
       
        foreach ($detalleProducto as $detalle) {
            $detalles = $producto->detalles;
        }
     
        return view('producto.index', compact('productos','insumos','detalleProducto'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // llamar insumos
        $insumos = Insumo::all();
        $users = User::all();
        return view('producto.create', compact('insumos', 'users'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $productos = Productos::create($request->all());
        // $productos->NombreProducto = $request->get('NombreProducto');
        // $productos->DescripcionProducto = $request->get('DescripcionProducto');
        // $productos->PrecioP = $request->get('PrecioP');
        // $productos->save();

        // crear nuevo detalle compra recorriendo un foreach de detalles
        // $productos = new Productos();
        $results = [];
        foreach ($request->id_insumos as $key => $insumos) {
            $results[$insumos] = [
                'id_insumos' => $request->id_insumos[$key], // 'id_insumo' => $request->id_insumo[$key], // 'id_insumo' => $request->id_insumo[$key],
                'Cantidad' => $request->Cantidad[$key]
                // 'Precio' => $request->Precio[$key],
            ];
        }
        // foreach ($request->id_insumo as $key => $insumos) {
        //     $results[] = [
        //         'id_insumo' => $request->id_insumo[$key],
        //         'Cantidad' => $request->Cantidad[$key]
        //         // 'Precio' => $request->Precio[$key],
        //     ];
        // }
        // foreach($request->id_insumo as $key => $insumos){
        //     $results[]=array(
        //         'id_insumo' => $request->id_insumo[$key],
        //         'Cantidad' => $request->Cantidad[$key]
        //     );
        // }

        // guardar registros de insumos en detalleProductos
        $productos->detalles()->createMany($results);
        // retornar vista
        return redirect('/productos')->with('mensaje', 'El producto se creo con exito');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = Productos::find($id);
        return view('insumo.show', compact('productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $productos= Productos::find($id);
        $insumos = Insumo::all();

        return view('producto.edit', compact('insumos', 'productos'));
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
        $productos= Productos::find($id);

        $productos->NombreProducto = $request->get('NombreProducto');
        $productos->DescripcionProducto = $request->get('Descripcion');
        $productos->Imagen = $request->Imagen ? $request->Imagen->storeAs('public', $request->Imagen->getClientOriginalName()) : $productos->Imagen;
        $productos->PrecioP = $request->get('PrecioP');
        $productos ->save();
        $productos->insumos()->sync($request->get('id_insumos'));
        return redirect('/productos') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Productos::find($id);
        $producto->delete();
        return redirect('/productos');
    }
}
