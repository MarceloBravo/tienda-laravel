<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EstadosRequest;
use App\Estado;
use Redirect;

class EstadosController extends Controller
{
    public function __construct()
    {
        $model = new Estado(); 
        $tabla = $model->getTable();
        $this->middleware('permisos:'.$tabla.',acceder')->only('index');
        $this->middleware('permisos:'.$tabla.',crear')->only('create','store');
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
        $estados = Estado::paginate(15);
        $filtro = "";
        return view('admin.estados.grid', compact('estados','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estado = new Estado();

        return view('admin.estados.create', compact('estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadosRequest $request)
    {
        $estado = new Estado();
        $insertado = $estado->fill($request->all())->save();

        $mensaje = $insertado ? "El registro ha sido ingresado." : "Ocurrió un error al intentar ingresar el registro.";
        $tipoMensaje = $insertado ? "success" : "danger";

        return Redirect::to("/admin/estados")->with("message",$mensaje)->with("type-message",$tipoMensaje);
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
        $estado = Estado::find($id);

        return view('admin.estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstadosRequest $request, $id)
    {
        $estado = Estado::find($id);
        $actualizado = $estado->fill($request->all())->save();

        $mensaje = $actualizado ? "El registro ha sido actualizado." : "Ocurrió un error al intentar actualizar el registro.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to("/admin/estados")->with("message",$mensaje)->with("type-message",$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado = Estado::find($id);
        $eliminado = $estado->delete();

        $mensaje = $eliminado ? "El registro ha sido eliminado." : "Ocurrió un error al intentar eliminar el registro.";
        $tipoMensaje = $eliminado ? "success" : "danger";

        return Redirect::to("/admin/estados")->with("message",$mensaje)->with("type-message",$tipoMensaje);
    }


    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/estados');
        }
        $filtro = $request->filtro;
        $estados = Estado::where('nombre', 'Like', '%'.$filtro.'%')
                            ->paginate(15);

        return view('admin.estados.grid', compact('estados','filtro'));
    }
}
