<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailFinVenta;
use Redirect;

class FinVentaController extends Controller
{
    use \App\Http\traits\CarritoTrait;
    
    public function finalizarVenta()
    {        
        return Redirect::to('/');   //Redireccionando a home
    }


    public function compraOk(Request $request)
    {
        $carrito = \Session::get('carrito');
        $total = $this->total();        

        \Mail::to(\Auth::user()->email)->send(new EmailFinVenta($carrito, $total)); //Enviando el email de notificación de la compra
        \Session::put('carrito', array());  //Vaciando el carro de compras
        \Session::flash('message','Felicidades, tu compra finalizó exitosamente.');
        return view('pages.pago-ok', compact('carrito','total'));
    }

    public function compraError(Request $request)
    {
        \Session::flash('error','Lo sentimos. Ocurrió un error en la transacción y la compra no pudo llevarse a cabo. <br/>Puedes intentarlo nuevamente mas tarde');
        return view('pages.pago-error');
    }
}
