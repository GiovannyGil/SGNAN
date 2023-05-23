<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;

class ReportController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    //     $this->middleware('can:reports.day')->only(['reports_day']);
    //     // $this->middleware('can:reports.month')->only(['reports_month']);
    //     $this->middleware('can:reports.date')->only(['reports_date']);
    // }
    public function reports_day(){
        // consulta de ventas
        $ventas = Venta::whereDate('created_at', Carbon::today())->get(); // traer las venta donde la fecha sea la actual
        $total = $ventas->sum('total');
        return view('venta.reports_day', compact('ventas', 'total'));
    }
    // public function reports_month(){
    //     return view('report.month');
    // }
    // public function reports_date(){

    //     $ventas = Venta::whereDate('created_at', Carbon::today('America/Bogota'))->get(); // traer las venta donde la fecha sea la selecionada
    //     $total = $ventas->sum('total');

    //     return view('venta.reports_date', compact('ventas', 'total') );
    // }
    // // funcion de resultados de consulta por fecha}
    // public function report_results(Request $request){
    //     $fI = $request->fecha_ini.'00:00:00';
    //     $fF = $request->fecha_fin.'23:59:59';

    //     $ventas = Venta::whereBetween('created_at', [$fI, $fF])->get();
    //     $total = $ventas->sum('total');
    //     return redirect()->route('ventas.reports_date', compact('ventas', 'total'));
    //     // return view('venta.reports_date', compact('ventas', 'total'));
    // }

    function reports_date(Request $request){
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        
        $ventas = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
        
        return view('venta.reports_date', ['ventas' => $ventas]);
    }
}
