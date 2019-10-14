<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Redirect;

class ShoppingController extends Controller
{
    use \App\Http\traits\CarritoTrait;

    public function __construct(){

        if(!\Session::has('carrito'))
            \Session::put('carrito', array());

        if(!\Session::has('subTotal'));
            \Session::put('subTotal', 0);
    }

    public function Home()
    {
        $destacados = Producto::where('visible','=',true)
                                ->limit('5')
                                ->get();
        //dd($destacados[0]->imagenes()->where('default','=',true)->first()->url);        
        $nuevos = Producto::where('visible','=',true)
                                ->OrderBy('updated_at','desc')
                                ->limit(5)
                                ->get();

        return view('welcome', compact('destacados','nuevos'));
    }

    public function detalle($id)
    {
        $producto = Producto::find($id);
        $relacionados = Producto::where('categoria_id','=',$producto->categoria_id)->limit(8)->get();
        
        return view('pages.detalle', compact('producto','relacionados'));
    }

    public function agregarAlCarrito(Producto $producto)
    {
        $this->agregarProducto($producto);
        \Session::put('subTotal', $this->total());

        return Redirect::to('/');
    }

    //Vaciar carrito
    public function vaciar()
    {
        \Session::forget('carrito');

        return Redirect::to('/');
    }



}
