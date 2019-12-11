<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Orden;
use App\Estado;
use Redirect;

class PedidosController extends Controller
{
    public function __construct()
    {
        $model = new Orden();
        $tabla = $model->getTable();   
        $this->middleware('permisos:'.$tabla.',acceder')->only('index');
        $this->middleware('permisos:'.$tabla.',actualizar')->only('edit','update');
        $this->middleware('permisos:'.$tabla.',eliminar')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Orden::paginate(15);
        $filtro = "";
        return view('admin.pedidos.grid', compact('pedidos','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Orden::find($id);
        $estados = Estado::pluck('nombre','id');

        return view('admin.pedidos.edit', compact('pedido','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pedido = Orden::find($id);
        $actualizado = $pedido->fill($request->all())->save();

        $mensaje = $actualizado ? "El pedido ha sido actualizado." : "Error al intentar actualizar el pedido.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to("/admin/pedidos")->with("message",$mensaje)->with("type-message",$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Orden::find($id);
        $actualizado = $pedido->delete();

        $mensaje = $actualizado ? "El pedido ha sido eliminado." : "Error al intentar eliminar el pedido.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to("/admin/pedidos")->with("message",$mensaje)->with("type-message",$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/pedidos');
        }
        $filtro = $request->filtro;
        $pedidos = Orden::join('users','ordenes.user_id','=','users.id')
                        ->join('estados','ordenes.estado_id','=','estados.id')
                        ->where('users.nombre','Like','%'.$filtro.'%')
                        ->orWhere('users.a_paterno','Like','%'.$filtro.'%')
                        ->orWhere('users.a_materno','Like','%'.$filtro.'%')
                        ->orWhere('ordenes.subtotal','Like','%'.$filtro.'%')
                        ->orWhere('ordenes.created_at','Like','%'.$filtro.'%')
                        ->orWhere('estados.nombre','Like','%'.$filtro.'%')
                        ->select('ordenes.*')
                        ->paginate(15);

        return view('admin.pedidos.grid', compact('pedidos', 'filtro'));
    }
}
