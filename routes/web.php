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
//Route::bind('producto', function($slug){
//    return App\Producto::where('slug','=',$slug)->first();
//});



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

//Rutas PayPal
Route::get('payment','PaypalController@postPayment');
Route::get('payment/status','PaypalController@getPaymentStatus')->name('payment.status');
Route::get('usd', 'PaypalController@getUSD');

// Rutas WebPay
Route::get('/checkout', 'CheckoutController@initTransaction')->name('checkout');  
Route::post('/checkout/webpay/response', 'CheckoutController@response')->name('checkout.webpay.response');  
Route::post('/checkout/webpay/finish', 'CheckoutController@finish')->name('checkout.webpay.finish');

Route::get('fin-compra', 'FinVentaController@finalizarVenta');
Route::get('pago-ok', 'FinVentaController@compraOk');
Route::get('pago-error', 'FinVentaController@compraError');


/* ****** ADMIN ******* */
Route::get('admin/home', 'Admin\HomeController@index');
Route::get('admin', 'Admin\HomeController@index');
Route::resource('admin/categorias', 'Admin\CategoriasController');
Route::post('admin/categorias-filtro', 'Admin\CategoriasController@filtrar');

Route::resource('admin/marcas','Admin\MarcasController');
Route::post('admin/marcas-filtro','Admin\MarcasController@filtrar');

Route::resource('admin/productos', 'Admin\ProductosController');
Route::post('admin/productos-filtro','Admin\ProductosController@filtrar');

Route::resource('admin/roles','Admin\RolesController');
Route::post('admin/roles-filtro','Admin\RolesController@filtrar');

Route::resource('admin/usuarios','Admin\UsuariosController');
Route::post('admin/usuarios-filtro','Admin\UsuariosController@filtrar');

Route::resource('admin/regiones','Admin\RegionesController');
Route::post('admin/regiones-filtro','Admin\RegionesController@filtrar');
Route::get('admin/get-regiones/{idPais}','Admin\RegionesController@getRegiones');

Route::resource('admin/comunas','Admin\ComunasController');
Route::post('admin/comunas-filtro','Admin\ComunasController@filtrar');
Route::get('admin/get-comunas/{idRegion}','Admin\ComunasController@getComunas');

Route::resource('admin/ciudades','Admin\CiudadesController');
Route::post('admin/ciudades-filtro','Admin\CiudadesController@filtrar');
Route::get('admin/get-ciudades/{idComuna}','Admin\CiudadesController@getCiudades');

Route::resource('admin/pantallas', 'Admin\PantallasController');
Route::post('admin/pantallas-filtro','Admin\PantallasController@filtrar');
Route::get('admin/pantallas-menus/{idPantalla}','Admin\PantallasController@getMenus');
Route::get('admin/pantallas-permisos/{idPantalla}','Admin\PantallasController@getPermisos');
