<?php

namespace App\Http\traits;

use Exception;
use Iluminate\Http\Request;
use App\Producto;

trait CarritoTrait{

    //Total
    public function total()
    {
        $total = 0;   
        if(\Session::has('carrito'))
        {
            $carrito = \Session::get('carrito');        
            foreach($carrito as $item){
                $total += $item->precio * $item->cantidad;
            }
        }
        return $total;
    }

    public function agregarProducto(Producto $producto)
    {
        $carrito = \Session::get('carrito');
        $producto->cantidad = 1;
        $carrito[$producto->slug] = $producto;
        \Session::put('carrito', $carrito);         
    }

    
}