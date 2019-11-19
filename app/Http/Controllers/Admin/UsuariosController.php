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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filtrar(Request $request)
    {
        
    }
}
