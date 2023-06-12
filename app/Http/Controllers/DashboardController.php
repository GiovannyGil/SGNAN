<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Insumo;
use App\Models\producto;
use Illuminate\Support\Facades\DB;

// llamar los modelos compra, venta, insumos, producto


class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $salesByMonth = DB::table('ventas')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
        
        $purchasesByMonth = DB::table('compras')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();


        // grafico para total de ventas por mes
        $ventasPorMes = Venta::selectRaw('SUM(total) as total, MONTH(created_at) as mes')
            ->groupBy('mes')
            ->get();

        $totalesPorMes = $ventasPorMes->pluck('total');
        $meses = $ventasPorMes->pluck('mes')->map(function ($mes) {
            return Carbon::create()->month($mes)->locale('es')->monthName;
        });

        // grafico de total compras por mes
        $comprasPorMes = Compra::selectRaw('SUM(total) as total, MONTH(created_at) as mes')
            ->groupBy('mes')
            ->get();

        $totalesPorMesCompras = $comprasPorMes->pluck('total');
        $mesesCompras = $comprasPorMes->pluck('mes')->map(function ($mes) {
            return Carbon::create()->month($mes)->locale('es')->monthName;
        });

       
        // traer la comparacion de cantidad de ventas y compras por mes

        $totalSales = DB::table('ventas')->count();
        // $SumaVentas = DB::table('ventas')->sum('total');
        $SumaVentas = DB::table('ventas')
            ->select(DB::raw('MONTH(created_at) AS mes, SUM(total) AS total_mes'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total_mes')
            ->first();
        $totalPurchases = DB::table('compras')->count();
        $suppliesCount = DB::table('insumos')->count();
        $productsCount = DB::table('productos')->count();
        $employeesCount = DB::table('empleados')->count();
        $provideersCount = DB::table('proveedors')->count();
        $categoryCount = DB::table('categorias')->count();

        // Puedes realizar más operaciones para obtener datos adicionales o estadísticas
        
        return view('dash.index', 
        compact(
        'salesByMonth',
        'totalSales',
        'totalPurchases',
        'suppliesCount',
        'productsCount',
        'employeesCount',
        'purchasesByMonth',
        'SumaVentas',
        'provideersCount',
        'categoryCount',
        'ventasPorMes',
        'totalesPorMes',
        'meses',
        'comprasPorMes',
        'totalesPorMesCompras',
        'mesesCompras',
    ));
    
    } 
    

}
