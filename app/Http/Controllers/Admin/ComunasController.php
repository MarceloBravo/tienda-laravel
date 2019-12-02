<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ComunasRequest;
use App\Comuna;
use App\Region;
use App\Pais;
use Redirect;

class ComunasController extends Controller
{
    private $pantalla = "Comunas";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comuna::paginate(15);
        $filtro = "";
        $pantalla = $this->pantalla;

        return view('admin.comunas.grid', compact('comunas','filtro','pantalla'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comuna = new Comuna();
        $paises = Pais::pluck('nombre','id');
        $regiones = Region::where('id','=',0)->pluck('nombre','id');
        $pantalla = $this->pantalla;

        return view('admin.comunas.create',compact('comuna','paises','regiones','pantalla'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComunasRequest $request)
    {
        $comuna = new Comuna();
        $result = $comuna->fill($request->all())->save();
        $mensaje = $result ? "El registro ha sido ingresado." : "Ocurrio un error al intentar ingresar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/comunas')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $comuna = Comuna::find($id);
        $comuna->pais = $comuna->region()->get()[0]->pais()->get()[0]->id;
        //$comuna->region = $comuna->region()->get()[0]->id;

        $paises = Pais::pluck('nombre','id');
        $regiones = Region::where('id_pais','=',$comuna->pais)->pluck('nombre','id');
        
        $pantalla = $this->pantalla;

        return view('admin.comunas.edit',compact('comuna','paises','regiones','pantalla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComunasRequest $request, $id)
    {
        $comuna = Comuna::find($id);
        $result = $comuna->fill($request->all())->save();
        $mensaje = $result ? "El registro ha sido actualizado." : "Ocurrio un error al intentar actualizar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/comunas')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comuna = Comuna::find($id);
        $result = $comuna->delete();
        $mensaje = $result ? "El registro ha sido eliminado." : "Ocurrio un error al intentar eliminar el registro.";
        $tipoMensaje = $result ? "success" : "danger";

        return Redirect::to('/admin/comunas')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('admin/comunas');
        }
        $pantalla = $this->pantalla;
        $filtro = $request->filtro;        
        $comunas = Comuna::join('regiones','comunas.id_region','=','regiones.id')
                            ->join('paises','regiones.id_pais','=','paises.id')
                            ->where('comunas.nombre','Like','%'.$filtro.'%')
                            ->orWhere('regiones.nombre','Like','%'.$filtro.'%')
                            ->orWhere('paises.nombre','Like','%'.$filtro.'%')
                            ->select('comunas.*')
                            ->paginate(15);

        return view('admin.comunas.grid',compact('comunas','filtro','pantalla'));
    }

    public function getComunas($idRegion)
    {
        $comunas = Comuna::where('id_region',$idRegion)->select('nombre','id')->get();
        return response()->json($comunas->ToArray());
    }
}
