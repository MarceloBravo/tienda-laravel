<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\OrdenItem;
use App\Oferta;
use Redirect;
use DB;

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
                                
        $masVendidos = Producto::join('ordenes_items','ordenes_items.id','=','productos.id')
                                ->OrderBy('ordenes_items.updated_at','desc')->limit(5)->get();
        
        DB::statement(DB::raw('set @row := 0'));
        $masVendidos2 = OrdenItem::join('productos','ordenes_items.producto_id','=','productos.id')
                                ->join('imagenes_productos','imagenes_productos.producto_id','=','productos.id')
                                ->join('categorias','categorias.id','=','productos.categoria_id')
                                ->where('imagenes_productos.default','=', true)
                                ->select(DB::raw('@row := @row + 1 as fila'),'productos.id','productos.nombre','productos.precio','productos.precio_anterior', 'productos.slug', 'imagenes_productos.url','categorias.nombre as categoria', 'imagenes_productos.default',DB::raw('count(productos.id) as cant'))                                
                                ->limit(6)
                                ->groupBy('productos.id','productos.nombre','productos.precio','productos.precio_anterior', 'imagenes_productos.url', 'productos.slug','categorias.nombre', 'imagenes_productos.default')
                                ->orderBy('cant','desc')
                                ->get();
                                //->toSql();
                                //dd($masVendidos2);
                                
        DB::statement(DB::raw('set @row := 0'));
        $masVendidos3 = OrdenItem::join('productos','ordenes_items.producto_id','=','productos.id')
                                ->join('imagenes_productos','imagenes_productos.producto_id','=','productos.id')
                                ->join('categorias','categorias.id','=','productos.categoria_id')
                                ->where('imagenes_productos.default', '=', true)
                                ->select(DB::raw('@row := @row + 1 as fila'),'productos.id','productos.nombre','productos.precio','productos.precio_anterior', 'productos.slug','imagenes_productos.url','categorias.nombre as categoria',DB::raw('count(productos.id) as cant'))
                                ->offset(6)                                
                                ->limit(6)
                                ->groupBy('productos.id','productos.nombre','productos.precio','productos.precio_anterior', 'productos.slug','imagenes_productos.url','categorias.nombre')
                                ->orderBy('cant','desc')
                                ->get();
        
        DB::statement(DB::raw('set @row := 0'));
        $masVendidos4 = OrdenItem::join('productos','ordenes_items.producto_id','=','productos.id')
                                ->join('imagenes_productos','imagenes_productos.producto_id','=','productos.id')
                                ->join('categorias','categorias.id','=','productos.categoria_id')
                                ->where('imagenes_productos.default', '=', true)
                                ->select(DB::raw('@row := @row + 1 as fila'),'productos.id','productos.nombre','productos.precio','productos.precio_anterior', 'productos.slug','imagenes_productos.url','categorias.nombre as categoria',DB::raw('count(productos.id) as cant'))
                                ->offset(12)
                                ->limit(6)
                                ->groupBy('productos.id','productos.nombre','productos.precio','productos.precio_anterior', 'imagenes_productos.url','categorias.nombre')
                                ->orderBy('cant','desc')
                                ->get();
        
        $ofertas = Oferta::where('portada','=',true)->get();

        return view('welcome', compact('destacados','nuevos','masVendidos','masVendidos2','masVendidos3','masVendidos4','ofertas'));
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
