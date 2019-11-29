<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rol;
use App\Permiso;
use App\Pantalla;
use Redirect;
use DB;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::paginate(15);
        $filtro = "";

        return view('admin.permisos.grid', compact('roles','filtro'));
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
    public function edit($idRol)
    {
        $subQry = Permiso::where('permisos.rol_id','=',$idRol);
                            //->get();

        DB::statement(DB::raw('set @row := 0'));
        $permisos = DB::table(DB::raw("({$subQry->toSql()}) as qry"))
                            ->mergeBindings($subQry->getQuery())
                            ->rightjoin('pantallas','qry.pantalla_id','=','pantallas.id')
                            ->select(DB::raw('@row := @row + 1 as fila'),'qry.*','pantallas.nombre as pantalla','pantallas.id as pantalla_id')
                            ->where('pantallas.permite_crear','=',1)
                            ->orWhere('pantallas.permite_actualizar','=',1)
                            ->orWhere('pantallas.permite_eliminar','=',1)
                            ->get();
                            
        return view('admin.permisos.edit', compact('permisos','idRol'));
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
        try{
            DB::beginTransaction();            
            $idAnterior = "";
            foreach($request->all() as $key => $value)
            {
                $inputName = explode('-',$key);
                $id = $inputName[0];                
                if($id != "_method" && $id != "_token" && $id != "_rol")
                {
                    $idPantalla = $inputName[1];
                    if($id.$idPantalla != $idAnterior)
                    {
                        $idAnterior = $id.$idPantalla;
                        $crear = isset($request[$id.'-'.$idPantalla.'-crear']) ? $request[$id.'-'.$idPantalla.'-crear'] : 0 ;
                        $actualizar = isset($request[$id.'-'.$idPantalla.'-actualizar']) ? $request[$id.'-'.$idPantalla.'-actualizar'] : 0;
                        $eliminar = isset($request[$id.'-'.$idPantalla.'-eliminar']) ? $request[$id.'-'.$idPantalla.'-eliminar'] : 0;

                        $this->grabar($id, $idPantalla, $request->_rol, $crear, $actualizar, $eliminar);
                    }
                }
            }
            DB::commit();
            $mensaje = "Los permisos han sido actualizados.";
            $tipoMensaje = "success";
        }catch(Exception $ex){
            DB::rollback();
            $mensaje = "Ocurrio un error al actualizar los permisos: ".$ex->getMessage();
            $tipoMensaje = "danger";
        }

        return Redirect::to('/admin/permisos')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/permisos');
        }
        $filtro = $request->filtro;
        $roles = Rol::where('nombre','Like','%'.$filtro.'%')
                    ->paginate(15);

        return view('admin.permisos.grid',compact('roles','filtro'));
    }

    
    private function grabar($id, $pantalla_id, $rol_id, $crear, $actualizar, $eliminar)
    {
        $permiso = Permiso::find($id);
        if(is_null($permiso))
        {
            $permiso = new Permiso();
            $permiso->pantalla_id = $pantalla_id;
            $permiso->rol_id = $rol_id;
        }
        $permiso->crear = $crear;
        $permiso->actualizar = $actualizar;
        $permiso->eliminar = $eliminar;

        return $permiso->save();
    }

}
