<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function reports_day(){
        // consulta de ventas
        $ventas = Venta::whereDate('created_at', Carbon::today())->get(); // traer las venta donde la fecha sea la actual
        $total = $ventas->sum('total');
        return view('venta.reports_day', compact('ventas', 'total'));
    }
    

    function reports_date(Request $request){
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        
        $ventas = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
        
        return view('venta.reports_date', ['ventas' => $ventas]);
    }
}
