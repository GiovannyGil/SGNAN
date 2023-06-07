<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Productos;
use App\Models\Empleado;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\Venta\StoreRequest;
use App\Http\Requests\Venta\UpdateRequest;
use Illuminate\Support\Facades\Auth;
// use Barryyvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:venta.index')->only('index');
        $this->middleware('auth');
    }
    public function index()
    { // ir o ver la vista del formulario
        $ventas = Venta::all();
        $productos = Productos::where('Estado', 'Activo')->get();

        return view('venta.index', compact('ventas','productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  // ir a la vista del formulario crear un registro
        // $productos = producto::all();
        $empleados = Empleado::all();
        $productos = Productos::where('Estado', 'Activo')->get();
        $users = User::all();
        return view('venta.create', compact('empleados', 'productos', 'users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    { // guardar un registro
        $venta = Venta::create($request->all()+[ 
            'user_id' => auth()->user()->id,
        ]);
        

        foreach ($request->id_producto as $key => $productos){
            // dd($request->id_producto[$key]);
            $resultado[] = array(
            "id_producto"=>$request->id_producto[$key],
            "Cantidad"=>$request->Cantidad[$key],
            "Precio"=>$request->Precio[$key]);
        }

        $venta->detalleVentas()->createMany($resultado);
        return redirect('/ventas')->with('Crear', 'Venta registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        $empleados = Empleado::all();
        $productos = Productos::all();
        $subtotal = 0; // variable para almacenar el subtotal
        $detalleVenta = $venta->detalleVentas; // detalle de la venta
        foreach ($detalleVenta as $detalle) { // recorremos el detalle de la venta
            $subtotal += $detalle->Cantidad * $detalle->Precio; // sumamos el subtotal
        }
        return view('venta.show', compact('venta', 'empleados', 'detalleVenta', 'subtotal', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { // editar un registro
        $venta = Venta::find($id);
        return view('venta.edit')->with('venta',$venta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { // actualizar un registro
        // $venta =  Venta::find($id);

        // $venta->NombreCliente = $request->get('NombreCliente');
        // $venta->Observaciones = $request->get('Observaciones');
        // $venta->Cantidad = $request->get('Cantidad');
        // $venta->Estado = $request->get('Estado');
        // $venta->ProcesoCompra = $request->get('ProcesoCompra');
        // $venta->Empleado_ID = $request->get('Empleado_ID');
        // $venta->PrecioUnitario = $request->get('PrecioUnitario');
        // $venta->ValorTotal =  $request->get('Cantidad') * $request->get('PrecioUnitario');

        // $venta->save();

        // return redirect('/ventas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { //eliminar un registro
        // $venta =  Venta::find($id);

        // $venta->delete();
        // return redirect('/ventas')->with("mensaje", "Venta Eliminada");
    }

    function pdf(Venta $venta){
        // $ventas = Venta::all();
        $productos = Productos::all();
        $empleados = Empleado::all();
        $subtotal = 0; // variable para almacenar el subtotal
        $detalleVenta = $venta->detalleVentas; // detalle de la venta
        foreach ($detalleVenta as $detalle) { // recorremos el detalle de la venta
            $subtotal += $detalle->Cantidad * $detalle->Precio; // sumamos el subtotal
        }
        $pdf = \PDF::loadView('venta.pdf', compact('venta', 'detalleVenta', 'subtotal', 'productos', 'empleados'));
        return $pdf->download('reporte_de_Venta_'.$venta->id.'.pdf');
    }

    // pdf de todalas las ventas
    function pdfAll(){
        $ventas = Venta::all();
        $productos = Productos::all();
        $empleados = Empleado::all();
        // sacar el total de todas las ventas
        $total = 0;
        $totalVenta=0;
        foreach ($ventas as $venta) {
            $totalVenta += $venta->total;
        }
        $pdf = \PDF::loadView('venta.pdfAll', compact('ventas', 'productos', 'empleados', 'totalVenta'));
        return $pdf->download('reporte_de_Ventas.pdf');
    }

    // funcion cambiar estado
    public function Cambiar_Estado(Venta $venta){
        if($venta->Estado == 'Pendiente'){
            $venta->update(['Estado' => 'Pagado']);
            return redirect()->back();
        }else{
            $venta->update(['Estado' => 'Peniente']);
            return redirect()->back();
        }
        $venta->save();
        return redirect('/ventas')->with('success', '!Proceso terminado¡');
    }

    // funcion cambiar proceso de compra, activo o inactivo
    // public function Cambiar_Proceso(Venta $venta){
    //     if($venta->Proceso == 'Activo'){
    //         $venta->update(['Proceso' => 'Inactivo']);
    //         return redirect()->back();
    //     }else{
    //         $venta->update(['Proceso' => 'Activo']);
    //         return redirect()->back();
    //     }
    //     $venta->save();
    //     return redirect('/ventas')->with('success', '!Se cambio el estado correctamente¡');
    // }



    public function actualizarVenta($id)
    {
        $venta = Venta::find($id);
        $venta->Estado = 'pago';
        $venta->updated_at = Carbon::now();
        $venta->save();

        $diferenciaTiempo = $venta->created_at->diffForHumans($venta->updated_at);

        return $diferenciaTiempo; // Devuelve la diferencia de tiempo en formato legible
    }


}
