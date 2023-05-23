<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\detalleProducto;
use App\Models\insumo;
use App\Models\User;
use App\Http\Requests\productoCreateRequest;
use App\Http\Requests\ProductoEditRequest;


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
    public function store( productoCreateRequest $request )
    {

        $productos = Productos::create($request->all()+[ 
            // 'user_id' => auth()->user()->id,
        ]);
       
        $results = [];
        foreach ($request->id_insumos as $key => $insumos)
         {
            $results[$insumos] = 
            [
                'id_insumos' => $request->id_insumos[$key], 
                'Cantidad' => $request->Cantidad[$key]
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
       
        if 
            ($imagen = $request->file('imagen')){
            $ruta = $imagen->store('imagen/');
            $ImagenProducto= date('ymdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($ruta, $ImagenProducto);
            // $productos['imagen'] = "$ImagenProducto";

            $productos->imagen = $ruta;
        }

        
        $productos->save();
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
        $detalleProducto= detalleProducto::all();
        $insumos = Insumo::all();
     
        if ($productos != null) {
            // Accede a la propiedad 'insumo' del objeto
            $insumo = $productos->insumo;
        }
       
        $detalleProducto = $productos->detalles;

        return view('producto.show', compact('productos','insumos','detalleProducto' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $request, $id)
    {
        $productos= Productos::find($id);
        $insumos = insumo::all();


        return view('producto.edit', compact('insumos', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoEditRequest $request, $id)
    {
        $productos= Productos::find($id);

        $productos->NombreProducto = $request->get('nombrePro');
        $productos->DescripcionProducto = $request->get('Descripcion');
        $productos->Imagen = $request->Imagen ? $request->Imagen->storeAs('public', $request->Imagen->getClientOriginalName()) : $productos->Imagen;
        $productos->PrecioP = $request->get('PrecioP');
        $productos ->save();
        $productos->insumos()->sync($request->get('id_insumos'));
        // $productos ->Estado = $request->get('Estado');
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
        $productos = Productos::findOrFail($id);
       
        $productos->save();
        return redirect('/productos')->with('success', 'Producto desactivado correctamente');
    }

    public function change_status( Productos $producto)
    {
        if($producto->Estado == 'Activo'){
            $producto->update(['Estado' => 'Inhactivo']);
            return redirect()->back();
        }else{
            $producto->update(['Estado' => 'Activo']);
            return redirect()->back();
        }
        // $productos->save();
        // return redirect('/productos')->with('success','Proceso terminado');

    }

}