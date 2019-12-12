<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\UsuariosRequest;
use App\User;
use App\Pais;
use App\Region;
use App\Comuna;
use App\Ciudad;
use App\Rol;
use Redirect;

class RegistroController extends Controller
{
    //Muestra el formulario de creación de usuario desde el front de la tienda 
    public function create()
    {
        $usuario = new User();
        $paises = Pais::pluck('nombre', 'id');    
        $rolId = Rol::where('default','=', true)->first();  
        $regiones = Region::where('id','=',null)->pluck('nombre', 'id');
        $comunas = Comuna::where('id','=',null)->pluck('nombre', 'id');;
        $ciudades = Ciudad::where('id','=',null)->pluck('nombre', 'id');;

        return view('pages.registro', compact('usuario', 'paises', 'rolId', 'regiones', 'comunas', 'ciudades'));
    }


    //Regisytro del usuario desde el Front de la|                                                        tienda
    public function store(UsuariosRequest $request)
    {
        $usuario = new User();
        $ingresado = $usuario->fill($request->all())->save();

        $mensaje = $ingresado ? "El usuario ha sido creado." : "Ocurrió un error al intentar registrar el usuario.";
        $tipoMensaje = $ingresado ? "success" : "danger";

        return Redirect::to("/login")->with("message",$mensaje)->with("type-message", $tipoMensaje);
    }
}
