<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Redirect;

class CarritoController extends Controller
{
    public function __construct()
    {
        if(!\Session::has('carrito')){
            \Session::put('carrito', array());
        }
    }

    //Mostrar carrito
    public function show()
    {
        $carrito = \Session::get('carrito');
    
        return view('pages.carrito', compact('carrito'));
    }

    //Agregar Item
    public function agregar(Producto $producto) //Ver la inyección de dependencia en routes/web.php 
    {
        $carrito = \Session::get('carrito');
        $producto->cantidad = 1;
        $carrito[$producto->slug] = $producto;
        \Session::put('carrito', $carrito);
        
        return Redirect::to('/carrito');
    }

    //Grabar transacción
    public function grabar()
    {
        //
    }


    //Vaciar carrito
    public function vaciar()
    {
        //
    }

    //Actualizar Item
    public function actualizar($slug)
    {
        //
    }

    //Eliminar item
    public function eliminar($slug)
    {
        //
    }


    //Total
    public function total()
    {

    }
}
