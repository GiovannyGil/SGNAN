<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Insumo;
use App\Models\User;
use App\Models\DetalleProducto;
use App\Http\Requests\productos\StoreRequest;
use App\Http\Requests\ProductoRequest;




use App\Http\Controllers\DB;


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
        $productos = Productos::orderBy('Estado', 'asc')->get();
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
    public function store(StoreRequest $request )
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

        // if ($request->hasFile('Imagen')) {
        //     $path = $request->file('Imagen')->store('public/imagen');
        //     $productos->Imagen = str_replace('public', 'storage', $path);
        // }

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $ImagenEmpleado = date('ymdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $ImagenEmpleado);
            $productos['imagen'] = "$ImagenEmpleado";
        }
        else{
            unset($productos['imagen']);
        }
        $productos->save();

        // retornar vista
        return redirect('/productos')->with('crear', 'Producto registrado exitosamente');
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
       
        $detalleProducto = $productos->detalles;
        $insumos = Insumo::all();
        return view('producto.show', compact('productos', 'detalleProducto', 'insumos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function edit(  $id)
    {
        // $productos= Productos::find($id);
        $productos= Productos::findOrFail($id);
        $insumos = Insumo::all();
        $detalleProductos = DetalleProducto::where('productos_id', $id)->get();

        return view('producto.edit', compact('insumos', 'productos', 'detalleProductos'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
        public function update( ProductoRequest $request, $id)
        {
            $productos = Productos::findOrFail($id);
            $productos->NombreProducto = $request->input('NombreProducto');
            $productos->DescripcionProducto = $request->input('Descripcion');
            $productos->PrecioP = $request->input('PrecioP');
            
            if ($imagen = $request->file('imagen')) {
                $rutaGuardarImg = 'imagen/';
                $ImagenEmpleado = date('ymdHis'). "." . $imagen->getClientOriginalExtension();
                $imagen->move($rutaGuardarImg, $ImagenEmpleado);
                $productos['imagen'] = "$ImagenEmpleado";
            }
            else{
                unset($productos['imagen']);
            }
            $productos->save();
           
        
            // Obtener los detalles actuales del producto
            $detallesActuales = DetalleProducto::where('productos_id', $id)->get();
        
            // Actualizar o eliminar los detalles existentes
            foreach ($detallesActuales as $index => $detalle) {
                // Verificar si el detalle existe en la solicitud
                $detalleId = $detalle->id;
                if (in_array($detalleId, $request->input('detalle_ids', []))) {
                    // Actualizar la cantidad del detalle existente
                    $detalle->Cantidad = $request->input('cantidad')[$index];
                    $detalle->save();
                } else {
                    // Eliminar el detalle si no se incluye en la solicitud
                    $detalle->delete();
                }
            }
        
            // Agregar nuevos detalles
            $nuevosDetalles = $request->input('nuevos_detalles', []);
            foreach ($nuevosDetalles as $nuevoDetalle) {
                if (!empty($nuevoDetalle['id_insumos']) && !empty($nuevoDetalle['Cantidad'])) {
                    $detalle = new DetalleProducto();
                    $detalle->productos_id = $id;
                    $detalle->id_insumos = $nuevoDetalle['id_insumos'];
                    $detalle->Cantidad = $nuevoDetalle['Cantidad'];
                    $detalle->save();
                }
            }
        
            return redirect('/productos')->with('mensaje', 'El producto se ha actualizado con éxito');
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