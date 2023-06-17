<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Requests\ComprasCreateRequest;
use App\Http\Requests\ComprasEditRequest;
use App\Http\Requests\compras\StoreRequest;
use App\Http\Requests\compras\UpdateRequest;
use App\Models\Compra;
use App\Models\Insumo;
use App\Models\Proveedor;
use App\Models\DetalleCompra;
use App\Models\User;
use Illuminate\Http\Request;

class CompraController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Proveedor = Proveedor::all();
        $compras = Compra::all();
        $Insumos = Insumo::all();
        return view('compra.index', compact('compras', 'Insumos', 'Proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Proveedor = Proveedor::where('status','ACTIVE')->get();
        $Insumos = Insumo::where('status','ACTIVE')->get();
        $users = User::all();
        return view('compra.create', compact('Insumos', 'Proveedor', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request){
        $compra = Compra::create($request->all()+[
            'id_user' => auth()->user()->id,
        ]);

        // crear nuevo detalle compra recorriendo un foreach de detalles

        
        foreach ($request->id_insumos as $key => $Insumos){
            $results[] = array(
            "id_insumos" => $request->id_insumos[$key],
            "Cantidad" => $request->Cantidad[$key],
            "Paquetes" => $request->Paquetes[$key],
            "Precio_Paquete" => $request->Precio_Paquete[$key],
            "Precio" => $request->Precio_Paquete[$key] / $request->Cantidad[$key],
        );
        }
        $compra->detalleCompra()->createMany($results);

        return redirect('/compras')->with('crear', 'Compra registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
        $Insumos = Insumo::all();
        $Proveedor = Proveedor::all();
        $subtotal = 0; // variable para almacenar el subtotal
        $detallecompras = $compra->detalleCompra; // detalle de la venta
        foreach ($detallecompras as $detalle){ // recorremos el detalle de la venta
            $subtotal += $detalle->Cantidad * $detalle->Precio; // sumamos el subtotal
        }
        return view('compra.show', compact('compra', 'Proveedor' , 'detallecompras', 'subtotal', 'Insumos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $compra = Compra::findOrFail($id);
        $TProveedor = Proveedor::all();
        $TInsumos = Insumo::all();
        return view('compra.edit', compact('TProveedor','TInsumos'))->with('compra', $compra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComprasEditRequest $request, $id)
    {
        //
        $compra = Compra::findorFail($id);

        $compra->Referencia_compra = $request->get('Referencia_compra');
        $compra->Fecha_compra = $request->get('Fecha_compra');
        $compra->Descripcion_compra = $request->get('Descripcion_compra');
        $compra->Precio_unitario = $request->get('Precio_unitario');
        $compra->id_insumos = $request->get('id_insumos');
        $compra->id_proveedores = $request->get('id_proveedores');
        

        $compra->save();

        return redirect('/compras')->with('edit', 'Compra actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $compra =  Compra::findorFail($id);
        $compra->delete();
        return redirect('/compras')->with('Eliminar ', 'Compra eliminada correctamente');
    }
    public function change_status( Compra $compra)
    {
        if ($compra->status == 'ACTIVE') {
            $compra->status = 'DEACTIVATED';

            $compra->save();
            // $detalleCompra = $compra->DetalleCompra()->first();
            // $Cantidad = $detalleCompra->Cantidad;

            // $insumos = Insumo::find($detalleCompra->id_insumos);
            // $insumos->Cantidad -= $Cantidad;
            // $insumos->save();

            return redirect()->back()->with('Desactivar', 'Compra Anulada Exitosamente');
        } else {
            return redirect()->back();
        }

    }




    // pdf de todalas las ventas
    function pdfAll(){
        $compras = Compra::all();
        $insumos = Insumo::all();
        // sacar el total de todas las ventas
        $total = 0;
        $totalCompra=0;
        foreach ($compras as $compra) {
            $totalCompra += $compra->total;
        }
        $pdf = \PDF::loadView('compra.pdfAll', compact('compras', 'insumos', 'totalCompra'));
        return $pdf->download('reporte_de_Compras.pdf');
    }

}

