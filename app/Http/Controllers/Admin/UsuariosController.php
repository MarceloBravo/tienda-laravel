<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UsuariosRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use App\Pais;
use App\Region;
use App\Comuna;
use App\Ciudad;
use Redirect;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filtro = "")
    {
        $usuarios = User::paginate(15);

        return view('admin.usuarios.grid',compact('usuarios','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = new User();
        $usuario->id_pais = null;
        $usuario->id_region = null;
        $usuario->id_comuna = null;

        $roles = Rol::pluck('nombre','id');
        $paises = Pais::pluck('nombre', 'id');
        $regiones = Region::where('id',null)->pluck('nombre','id');
        $comunas = Comuna::where('id',null)->pluck('nombre','id');
        $ciudades = Ciudad::where('id',null)->pluck('nombre','id');
        
        return view('admin.usuarios.create',compact('usuario','roles','paises','regiones','comunas','ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariosRequest $request)
    {
        $usuario = new User();
        if(is_null($request->password) || $request->password == "")
        {
            $creado = $usuario->fill($request->except(['password']))->save();
        }else{
            $creado = $usuario->fill($request->all())->save();
        }
        $mensaje = $creado ? "El usuario ha sido creado" : "Ocurrió un error al intentar crear el usuario.";
        $tipoMensaje = $creado ? "success" : "danger";

        return Redirect::to('/admin/usuarios')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $usuario = User::find($id);

        $comuna = Comuna::find($usuario->ciudad->id_comuna);
        $region = Region::find($comuna->id_region);
        $pais = Pais::find($region->id_pais);

        $roles = Rol::pluck('nombre','id');
        $paises = Pais::pluck('nombre','id');
        $regiones = Region::where('id_pais',$pais->id)->pluck('nombre', 'id');
        $comunas = Comuna::where('id_region',$region->id)->pluck('nombre', 'id');
        $ciudades = Ciudad::where('id_comuna', $comuna->id)->pluck('nombre', 'id');

        $usuario->id_pais = $pais->id;
        $usuario->id_region = $region->id;
        $usuario->id_comuna = $comuna->id;

        return view('admin.usuarios.edit',compact('usuario','roles','paises','regiones','comunas','ciudades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuariosRequest $request, $id)
    {
        $usuario = User::find($id);
        if($request->password == "")
        {
            $grabado = $usuario->fill($request->except(['password']))->save();
        }else{
            $grabado = $usuario->fill($request->all())->save();
        }
        $mensaje = $grabado ? "El usuario ha sido actualizado." : "Ocurrió un error al intentar actualizar el registro.";
        $tipoMensaje = $grabado ? "success" : "danger";

        return Redirect::to('/admin/usuarios')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $eliminado = $usuario->delete();
        $mensaje = $eliminado ? "El usuario ha sido eliminado." : "Error al intentar eliminar el registro.";
        $tipoMensaje = $eliminado ? "success" : "danger";

        return Redirect::to('/admin/usuarios')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        $filtro = $request->filtro;
        if($filtro == ""){
            return Redirect::to('/admin/usuarios');
        }
        $usuarios = User::join('roles','users.rol_id','=','roles.id')
                        ->where('users.nombre','Like','%'.$filtro.'%')
                        ->orWhere('users.a_paterno','Like','%'.$filtro.'%')
                        ->orWhere('users.a_materno','Like','%'.$filtro.'%')
                        ->orWhere('users.nickname','Like','%'.$filtro.'%')
                        ->orWhere('roles.nombre','Like','%'.$filtro.'%')
                        ->select('users.*')
                        ->paginate(15);
        return view('admin.usuarios.grid', compact('usuarios','filtro'));                        
    }
}
