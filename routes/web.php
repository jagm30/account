<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CategoriaproductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PagoservicioController;
use App\Http\Controllers\ContadorController;
use App\Http\Controllers\CatservicioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('productos/edicion/{id_producto}/{nombre}/{descripcion}/{categoria}/{precio}/{precioPromocion}',[App\Http\Controllers\ProductoController::class,'edicion'])->name('edicion');
Route::get('productos/delete/{id}', [App\Http\Controllers\ProductoController::class,'destroy'])->name('destroy');
Route::resource('/productos', ProductoController::class);
Route::resource('/categoriaproductos', CategoriaproductoController::class);
Route::get('usuarios/delete/{id}', [App\Http\Controllers\UsuarioController::class,'destroy'])->name('eliminauser');
Route::get('usuarios/edicion/{id_usuario}/{nombre}/{email}/{password}/{tipo_usuario}',[App\Http\Controllers\UsuarioController::class,'edicion'])->name('edicionUser');
Route::resource('/usuarios', UsuarioController::class);
Route::get('/clientes/edicion/{id_cliente}/{apaterno}/{amaterno}/{nombre}/{email}/{telefono}/{direccion}/{ciudad}/{estado}',[App\Http\Controllers\ClienteController::class,'edicion'])->name('edicioncliente');
Route::get('clientes/delete/{id}', [App\Http\Controllers\ClienteController::class,'destroy'])->name('eliminacliente');
Route::resource('/clientes', ClienteController::class);

Route::get('servicios/delete/{id}', [App\Http\Controllers\ServicioController::class,'destroy'])->name('eliminaservicio');
Route::get('servicios/estadoCuenta/{id_usuario}', [App\Http\Controllers\ServicioController::class,'estadoCuenta'])->name('estadoCuenta');
Route::resource('/servicios', ServicioController::class);

Route::resource('/pagoservicios', PagoservicioController::class);

Route::resource('/catservicios', CatservicioController::class);

Route::get('contador/cuentacliente/update/{id_servicio}/{statusservicio}/{statuspago}', [App\Http\Controllers\ContadorController::class,'cuentaclienteupdate'])->name('cuentaclienteupdate');
Route::get('contador/cuentaclientes', [App\Http\Controllers\ContadorController::class,'cuentasclientes'])->name('cuentasClientes');
Route::get('contador/cuentacliente/{id}', [App\Http\Controllers\ContadorController::class,'cuentacliente'])->name('cuentaCliente');
Route::get('contador/createservicio/{id_cliente}', [App\Http\Controllers\ContadorController::class,'createservicio'])->name('createservicio');
Route::resource('/contador', ContadorController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');