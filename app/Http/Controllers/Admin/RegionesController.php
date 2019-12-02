<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegionesRequest;
use App\Region;
use App\Pais;
use Redirect;

class RegionesController extends Controller
{
    private $pantalla = "Regiones";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regiones = Region::orderBy('id_pais','asc')->paginate(15);
        $filtro = "";
        $pantalla = $this->pantalla;

        return view('admin.regiones.grid', compact('pantalla','regiones','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = new Region();
        $paises = Pais::pluck('nombre','id');
        $pantalla = $this->pantalla;

        return view('admin.regiones.create', compact('pantalla','region','paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionesRequest $request)
    {
        $region = new Region();
        $result = $region->fill($request->all())->save();
        $mensaje = $result ? "El registro ha sido ingresado" : "Ocurrió un error al intentar ingresar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/regiones')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $region = Region::find($id);
        $paises = Pais::pluck('nombre','id');
        $pantalla = $this->pantalla;
        
        return view('admin.regiones.edit',compact('pantalla','region','paises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionesRequest $request, $id)
    {
        $region = Region::find($id);
        $result = $region->fill($request->all())->save();
        $mensaje = $result ? "El registro ha sido actualizado" : "Ocurrió un error al intentar actualizar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/regiones')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $result = $region->delete();  
        $mensaje = $result ? "El registro ha sido eliminado" : "Ocurrió un error al intentar eliminar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/regiones')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/regiones');
        }
        $filtro = $request->filtro;
        $regiones = Region::join('paises','regiones.id_pais','=','paises.id')
                        ->where('regiones.nombre','like','%'.$filtro.'%')
                        ->orWhere('paises.nombre','like','%'.$filtro.'%')
                        ->select('regiones.*')
                        ->orderBy('id_pais','asc')
                        ->paginate(15);
        $pantalla = $this->pantalla;

        return view('admin.regiones.grid',compact('pantalla','regiones','filtro'));
        
    }

    public function getRegiones($idPais)
    {
        $regiones = Region::where('id_pais',$idPais)->select('nombre','id')->get();
        return response()->json($regiones->ToArray());
    }
}
