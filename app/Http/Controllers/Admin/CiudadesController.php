<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CiudadesRequest;
use App\Ciudad;
use App\Region;
use App\Comuna;
use App\Pais;
use Redirect;

class CiudadesController extends Controller
{
    private $pantalla = "Ciudades";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::paginate(15);
        $pantalla = $this->pantalla;
        $filtro = "";

        return view('admin.ciudades.grid', compact('ciudades','filtro','pantalla'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudad = new Ciudad();
        $paises = Pais::pluck('nombre','id');    
        $regiones = Region::where('id','=',0)->pluck('nombre','id');
        $comunas = Comuna::where('id','=',0)->pluck('nombre','id');

        $pantalla = $this->pantalla;

        return view('admin.ciudades.create',compact('ciudad','paises','regiones','comunas','pantalla'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CiudadesRequest $request)
    {
        $ciudad = new Ciudad();
        $result = $ciudad->fill($request->all())->save();
        $mensaje = $result ? "El registro ha sido ingresado." : "Ocurrio un error al intentar ingresar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/ciudades')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $ciudad = Ciudad::find($id);
        $ciudad->pais = $ciudad->comuna()->get()[0]->region()->get()[0]->pais()->get()[0]->id;
        $ciudad->region = $ciudad->comuna()->get()[0]->region()->get()[0]->id;
        $ciudad->comuna = $ciudad->comuna()->get()[0]->id;
        
        $paises = Pais::pluck('nombre','id');
        $regiones = Region::where('id_pais','=',$ciudad->pais)->pluck('nombre','id');
        $comunas = Comuna::where('id_region','=',$ciudad->region)->pluck('nombre','id');        

        $pantalla = $this->pantalla;

        return view('admin.ciudades.edit',compact('ciudad','paises','regiones','comunas','pantalla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CiudadesRequest $request, $id)
    {
        $ciudad = Ciudad::find($id);
        $result = $ciudad->fill($request->all())->save();        
        $mensaje = $result ? "El registro ha sido actualizado." : "Ocurrio un error al intentar actualizar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/ciudades')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ciudad = Ciudad::find($id);
        $result = $ciudad->delete();
        $mensaje = $result ? "El registro ha sido eliminado." : "Ocurrio un error al intentar eliminar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/ciudades')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/ciudades');
        }
        $pantalla = $this->pantalla;
        $filtro = $request->filtro;        
        $ciudades = Ciudad::join('comunas','ciudades.id_comuna','=','comunas.id')
                        ->join('regiones','comunas.id_region','=','regiones.id')
                        ->join('paises','regiones.id_pais','=','paises.id')
                        ->where('ciudades.nombre','Like','%'.$filtro.'%')
                        ->orWhere('comunas.nombre','Like','%'.$filtro.'%')
                        ->orWhere('regiones.nombre','Like','%'.$filtro.'%')
                        ->orWhere('paises.nombre','Like','%'.$filtro.'%')
                        ->select('ciudades.*')
                        ->paginate(15);

        return view('admin.ciudades.grid', compact('ciudades','filtro','pantalla'));
    }

    public function getCiudades($idComuna)
    {
        $ciudades = Ciudad::where('id_comuna',$idComuna)->select('nombre','id')->get();
        return response()->json($ciudades->ToArray());
    }
}
