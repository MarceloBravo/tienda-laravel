<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


//Iyectando dependencias
Route::bind('producto', function($slug){
    return App\Producto::where('slug','=',$slug)->first();
});

//Definiendo rutas
Route::get('/','ShoppingController@Home');
Route::get('/agregar/{producto}','ShoppingController@agregarAlCarrito');
Route::get('/vaciarCarrito','ShoppingController@vaciar');
Route::get('detalle/{id}','ShoppingController@detalle');

Route::get('carrito','CarritoController@show');
Route::get('carrito/agregar/{producto}','CarritoController@agregar');   //producto debe ser el mismo nombre utilizado en la inyección de dependencias
Route::get('carrito/grabar','CarritoController@grabar');
Route::get('carrito/vaciar','CarritoController@vaciar');
Route::get('carrito/actualizar/{producto}','CarritoController@actualizar');
Route::get('carrito/eliminar/{producto}','CarritoController@eliminar');
Route::get('carrito/total','CarritoController@total');
Route::get('carrito/{producto}/{cantidad}','CarritoController@cantidad');

Route::get('detalle-compra','DetalleCompraController@index')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('payment','PaypalController@postPayment');
Route::get('payment/status','PaypalController@getPaymentStatus')->name('payment.status');

Route::get('usd', 'PaypalController@getUSD');