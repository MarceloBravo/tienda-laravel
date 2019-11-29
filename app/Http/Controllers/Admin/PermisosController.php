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
                            ->select(DB::raw('@row := @row + 1 as fila'),'qry.*','pantallas.nombre as pantalla')
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
        dd($request);
        try{
            DB::beginTransaction();
            foreach($request as $item)
            {
                dd($item);
            }
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
        }
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
}
