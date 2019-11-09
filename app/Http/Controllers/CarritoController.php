<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Redirect;


class CarritoController extends Controller
{
    use \App\Http\traits\CarritoTrait;

    public function __construct()
    {
        if(!\Session::has('carrito'))
            \Session::put('carrito', array());
        

        if(!\Session::has('subTotal'))
            \Session::put('subTotal', 0);
    }

    //Mostrar carrito
    public function show()
    {
        $carrito = \Session::get('carrito');
        $total = $this->total();
        \Session::put('subTotal', $total);
        return view('pages.carrito', compact('carrito','total'));
    }

    //Agregar Item
    //public function agregar(Producto $producto) //Ver la inyección de dependencia en routes/web.php 
    public function agregar($slug) 
    {
        $producto = Producto::where('slug','=',$slug)->first();
        $this->agregarProducto($producto); //Trait

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
        \Session::forget('carrito');

        return Redirect::to('carrito');

    }

    //Actualizar Item
    public function actualizar($slug)
    {
        //
    }

    //Modificar Cantidad del producto
    public function cantidad($slug, $cantidad)
    {
        $producto = Producto::where('slug','=',$slug)->first();
        $carrito = \Session::get('carrito');
        $carrito[$producto->slug]->cantidad = $cantidad;
        \Session::put('carrito', $carrito);

        return Redirect::to('/carrito');
    }

    //Eliminar item
    public function eliminar($slug)
    {
        $producto = Producto::where('slug','=',$slug)->first();
        $carrito = \Session::get('carrito');
        unset($carrito[$producto->slug]);
        \Session::put('carrito',$carrito);

        return Redirect::to('/carrito');
    }
    
}
