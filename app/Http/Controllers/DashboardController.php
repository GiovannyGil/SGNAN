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
        



    // Obtener ventas por mes
    $salesByMonth = DB::table('ventas')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

    // Obtener compras por mes
    $purchasesByMonth = DB::table('compras')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

    // Arreglos para almacenar los datos de ventas y compras por mes
    $salesData = [];
    $purchasesData = [];

    // Inicializar los arreglos con cero para los 12 meses
    for ($month = 1; $month <= 12; $month++) {
        $salesData[$month] = 0;
        $purchasesData[$month] = 0;
    }

    // Asignar los valores de ventas por mes al arreglo correspondiente
    foreach ($salesByMonth as $sale) {
        $salesData[$sale->month] = $sale->count;
    }

    // Asignar los valores de compras por mes al arreglo correspondiente
    foreach ($purchasesByMonth as $purchase) {
        $purchasesData[$purchase->month] = $purchase->count;
    }

        // ------
        // $salesByDayOfWeek = DB::table('ventas')
        //     ->select(DB::raw('DAYOFWEEK(created_at) as dayOfWeek'), DB::raw('COUNT(*) as count'))
        //     ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
        //     ->get();

        $salesByDayOfWeek = DB::table('ventas')
            ->select(DB::raw('DAYOFWEEK(created_at) as dayOfWeek'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
            ->get();

        // Construye un arreglo con los resultados de la consulta
        $salesData = [];
        foreach ($salesByDayOfWeek as $sale) {
            $salesData[$sale->dayOfWeek] = $sale->count;
        }

        // Rellena los días sin ventas con cero
        for ($day = 1; $day <= 7; $day++) {
            if (!isset($salesData[$day])) {
                $salesData[$day] = 0;
            }
        }

        // Ordena los datos según el día de la semana
        ksort($salesData);

        // Construye el arreglo final para el gráfico
        $salesCounts = array_values($salesData);


        $comprasByDayOfWeek = DB::table('compras')
            ->select(DB::raw('DAYOFWEEK(created_at) as dayOfWeek'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
            ->get();

        $comprasData = [];
        foreach ($comprasByDayOfWeek as $compra) {
            $comprasData[$compra->dayOfWeek] = $compra->count;
        }

        for ($day = 1; $day <= 7; $day++) {
            if (!isset($comprasData[$day])) {
                $comprasData[$day] = 0;
            }
        }

        ksort($comprasData);

        $comprasCounts = array_values($comprasData);

        // --------------------

        // // Obtener valores totales de ventas por mes
        // $ventasPorMes = DB::table('ventas')
        // ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('SUM(total) as total'))
        // ->groupBy(DB::raw('MONTH(created_at)'))
        // ->get();

        // // Obtener valores totales de compras por mes
        // $comprasPorMes = DB::table('compras')
        //     ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('SUM(total) as total'))
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->get();

       
        // traer la comparacion de cantidad de ventas y compras por mes

        $totalSales = DB::table('ventas')->count();
        $SumaVentas = DB::table('ventas')->sum('total');
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
        'salesByDayOfWeek',
        'salesData',
        'salesCounts',
        'comprasByDayOfWeek',
        'comprasCounts',
        'salesData',
        'purchasesData',
        // 'ventasPorMes',
        // 'comprasPorMes',


    ));
    
    }
    

}
