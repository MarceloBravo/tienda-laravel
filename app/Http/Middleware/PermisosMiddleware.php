<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Pantalla;
use App\Permiso;
use App\Rol;

class PermisosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tabla="", $accion="")
    {
        if(!is_null(\Auth::user()) && $this->permisosRol(\Auth::user()->rol()->first()->id, $tabla, $accion))
        {
            return $next($request);
        }
        return route('/');
    }


    private function permisosRol($roles, $tabla, $accion)
    {
        $resp = false;
        if(is_array($roles))
        {
            foreach($roles as $rol)
            {
                $resp = $this->validaPermisoRol($rol, $tabla, $accion);
                if($resp)return $resp;
            }
        }else{
            $resp = $this->validaPermisoRol($roles, $tabla, $accion);
        }
        return $resp;
    }


    private function validaPermisoRol($rol, $tabla, $accion)
    {
        $rol = Rol::where('id','=',$rol)->first();
        if(is_null($rol))return false;

        $pantalla = Pantalla::where('tabla','=',$tabla)->first();
        if(is_null($pantalla))return false;
        
        $permisos = Permiso::where('rol_id','=',$rol->id)
                            ->where('pantalla_id','=',$pantalla->id)
                            ->Where($accion,'=', true)
                            ->get();

        return !is_null($permisos);
    }
}
