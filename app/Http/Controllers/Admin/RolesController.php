<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;
use App\Rol;
use Redirect;

class RolesController extends Controller
{

    public function __construct()
    {
        $model = new Rol(); 
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
        $roles = Rol::paginate(15);

        return view('admin.roles.grid',compact('roles','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = new Rol();

        return view('admin.roles.create',compact('rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $rol = new Rol();
        $grabado = $rol->fill($request->all())->save();
        
        $mensaje = $grabado ? "El rol ha sido ingresado." : "Error al intentar grabar el registro.";
        $tipoMensaje = $grabado ? "success" : "danger";

        return Redirect::to('/admin/roles')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $rol = Rol::find($id);

        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, $id)
    {
        $rol = Rol::find($id);
        $actualizado = $rol->fill($request->all())->save();
        
        $mensaje = $actualizado ? "El registro ha sido actualizado" : "Ocurrio un error al intentar actualizar el registro.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to('/admin/roles')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        $eliminado = $rol->delete();

        $mensaje = $eliminado ? "El rol ha sido eliminado." : "Ocurrió un error al intentar eliminar el rol.";
        $tipoMensaje = $eliminado ? "success" : "danger";

        return Redirect::to('/admin/roles')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        $filtro = $request->filtro;
        if($filtro == ""){
            return Redirect::to('/admin/roles');
        }    
        $roles = Rol::where('nombre','Like','%'.$filtro.'%')
                    ->orWhere('descripcion','Like','%'.$filtro.'%')
                    ->paginate(15);

        return view('admin.roles.grid', compact('roles','filtro'));
    }
}
