<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PantallasRequest;
use App\Pantalla;
use Redirect;

class PantallasController extends Controller
{

    public function __construct()
    {
        $model = new Pantalla(); 
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
    public function index($filtro = "")
    {
        $pantallas = Pantalla::paginate(15);

        return view('admin.pantallas.grid',compact('pantallas','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pantalla = new Pantalla();

        return view('admin.pantallas.create', compact('pantalla'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PantallasRequest $request)
    {
        $pantalla = new Pantalla();
        $creado = $pantalla->fill($request->all())->save();
        
        $mensaje = $creado ? "La apantalla fue registrada." : "Error al intentar registrar la pantalla.";
        $tipoMensaje = $creado ? "success" : "danger";

        return Redirect::to('/admin/pantallas')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $pantalla = Pantalla::find($id);

        return view('admin.pantallas.edit',compact('pantalla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PantallasRequest $request, $id)
    {
        $pantalla = Pantalla::find($id);
        $actualizado = $pantalla->fill($request->all())->save();

        $mensaje = $actualizado ? "El registro ha sido actualizado." : "Ocurrió un error al intentar actualizar el registro.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to('/admin/pantallas')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pantalla = Pantalla::find($id);
        $eliminado = $pantalla->delete();

        $mensaje = $eliminado ? "El registro ha sido eliminado." : "Ocurrió un error al intentar eliminar el registro.";
        $tipoMensaje = $eliminado ? "success" : "danger";

        return Redirect::to('/admin/pantallas')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }


    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/pantallas');
        }
        $filtro = $request->filtro;
        $pantallas = Pantalla::Where('nombre','Like','%'.$filtro.'%')
                            ->paginate(15);

        return view('admin.pantallas.grid',compact('pantallas','filtro'));
    }


    public function getMenus($idPantalla)
    {
        $pantallas = Pantalla::Find($idPantalla);
        $menus = $pantallas->menus()->get();
        
        return response()->json($menus->ToArray());
    }


    public function getPermisos($idPantalla)
    {
        $pantallas = Pantalla::Find($idPantalla);
        $permisos = $pantallas->permisos()->get();
        
        return response()->json($permisos->ToArray());
    }
}
