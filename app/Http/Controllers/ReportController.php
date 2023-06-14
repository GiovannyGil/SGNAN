<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function reports_day(){
        // consulta de ventas
        $ventas = Venta::whereDate('created_at', Carbon::today())->get();
        // traer las venta donde la fecha sea la actual
        $total = $ventas->sum('total');
        return view('venta.reports_day', compact('ventas', 'total'));
    }
    

    function reports_date(Request $request){
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        
        // Sumar un día a la fecha de fin
        $fechaFin = date('Y-m-d', strtotime($fechaFin . ' + 1 day'));

        
        // Realizar la consulta usando el rango de fechas actualizado
        $ventas = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();

        // Restar un día a la fecha de fin para mostrarla correctamente en la vista
        $fechaFin = date('Y-m-d', strtotime($fechaFin . ' - 1 day'));


        return view('venta.reports_date', compact('ventas', 'fechaInicio', 'fechaFin'));
    }
}
