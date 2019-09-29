<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ShoppingController extends Controller
{
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
}
