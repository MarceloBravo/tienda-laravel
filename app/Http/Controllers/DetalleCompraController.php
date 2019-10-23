<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class DetalleCompraController extends Controller
{
    use \App\Http\traits\CarritoTrait;

    public function index()
    {
        if(!\Session::has('carrito') || count(\Session::get('carrito')) == 0)
            return Redirect::back();

        $carrito = \Session::get('carrito');
        $total = $this->total();

        return view('pages.detalle-compra', compact('carrito', 'total'));
    }
}
