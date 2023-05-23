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

        $totalSales = DB::table('ventas')->count();
        $SumaVentas = DB::table('ventas')->sum('total');
        $totalPurchases = DB::table('compras')->count();
        $suppliesCount = DB::table('insumos')->count();
        $productsCount = DB::table('productos')->count();
        $employeesCount = DB::table('empleados')->count();

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
        'SumaVentas'
    ));
    
    } 
    

}
