<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();
Route::get('ventas/pdf/{venta}', 'App\Http\Controllers\VentaController@pdf')->name('ventas.pdf');
Route::get('ventas/pdfAll/', 'App\Http\Controllers\VentaController@pdfAll')->name('ventas.pdfAll');
Route::get('ventas/reports_day/', 'App\Http\Controllers\ReportController@reports_day')->name('ventas.reports_day');
Route::get('ventas/reports_date/', 'App\Http\Controllers\ReportController@reports_date')->name('ventas.reports_date');



Route::get('/compras', [App\Http\Controllers\CompraController::class, 'index']);
Route::get('/insumos', [App\Http\Controllers\InsumoController::class, 'index']);
Route::post('/compras', [App\Http\Controllers\CompraController::class, 'store']);
Route::get('/compras/create', [App\Http\Controllers\CompraController::class, 'create']);
Route::post('/compras', [App\Http\Controllers\CompraController::class, 'store']);

Route::get('compras/pdf/{compra}', 'App\Http\Controllers\CompraController@pdf')->name('compras.pdf');
Route::get('compras/pdfAll/', 'App\Http\Controllers\CompraController@pdfAll')->name('compras.pdfAll');

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        
        return view('dash.index');
    })->name('dash');
});

Route::get('/dash', 'App\Http\Controllers\DashboardController@index')->name('dash');

//USUARIOS
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
        'verified'
])->group(function () {
Route::resource('users', 'App\http\Controllers\UserController');
});

//EMPLEADOS

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
        'verified'
])->group(function () {
Route::resource('empleados', 'App\http\Controllers\EmpleadoController');
});

// VENTAS

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
        'verified'
])->group(function () {
    Route::resource('ventas', 'App\Http\Controllers\VentaController');
});

Route::get('Cambiar_Estado/ventas/{venta}','App\Http\Controllers\VentaController@Cambiar_Estado')->
name('Cambiar.Estado.ventas');

//Productos
Route::resource('productos', 'App\Http\Controllers\ProductoController');
Route::post('productos/', 'App\Http\Controllers\ProductoController@store');
Route::get('/productos/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.update');

Route::get('/productos/{producto}/change_status', [App\Http\Controllers\ProductoController::class,'change_status'])
    ->name('productos.change_status');



//ROLES
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
        'verified'
])->group(function () {
Route::resource('roles', 'App\http\Controllers\RoleController');
});

Route::get('/empleados/{empleado}/change_status', [App\http\Controllers\EmpleadoController::class,'change_status'])
    ->name('empleados.change_status');

Route::get('/users/{user}/change_status', [App\http\Controllers\UserController::class,'change_status'])
    ->name('users.change_status');

Route::get('/roles/{role}/change_status', [App\http\Controllers\RoleController::class,'change_status'])
    ->name('roles.change_status');


// compras
Route::resource('compras', 'App\Http\Controllers\CompraController');
Route::get('/compras/{compra}/change_status', [App\http\Controllers\CompraController::class,'change_status'])
    ->name('compras.change_status');


    
// insumos 
Route::resource('insumos', 'App\Http\Controllers\InsumoController');
Route::get('/insumos/{insumo}/change_status', [App\http\Controllers\InsumoController::class,'change_status'])
    ->name('insumos.change_status');

Route::get('/verificar-stock', 'App\http\Controllers\InsumoController@verificarStock')->name('verificar.stock');


// proveedores 
Route::resource('proveedores', 'App\Http\Controllers\ProveedorController');
Route::get('/proveedores/{proveedor}/change_status', [App\http\Controllers\ProveedorController::class,'change_status'])
    ->name('proveedores.change_status');
// ruta para show de compras
// Route::get('/compra/show/{compra}', [App\http\Controllers\CompraController::class,'show'])
//     ->name('compra.show'); 

//Categoria
Route::resource('categorias', 'App\Http\Controllers\CategoriaController');
Route::get('/categorias/{categoria}/change_status', [App\http\Controllers\CategoriaController::class,'change_status'])
->name('categorias.change_status');

Route::get('/productos/{producto}/change_status', [App\Http\Controllers\ProductoController::class, 'change_status'])
        ->name('producto.change_status');
