<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaisesRequest;
use App\Pais;
use Redirect;

class PaisesController extends Controller
{
    private $pantalla = 'Paises';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::paginate(15);        
        $pantalla = $this->pantalla;
        $filtro = '';

        return view('admin.paises.grid',compact('pantalla','paises','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pais = new Pais();
        $pantalla = $this->pantalla;

        return view('admin.paises.create', compact('pantalla','pais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaisesRequest $request)
    {
        $pais = new Pais();
        $creado = $pais->fill($request->all())->save();
        $mensaje = $creado ? "El registro ha sido creado." : "Error al intentar registrar el pais.";
        $tipoMensaje = $creado ? "success" : "danger";

        return Redirect::to('/admin/paises')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $pais = Pais::find($id);
        $pantalla = $this->pantalla;

        return view('admin.paises.edit', compact('pantalla','pais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaisesRequest $request, $id)
    {
        $pais = Pais::find($id);
        $actualizado = $pais->fill($request->all())->save();
        $mensaje = $actualizado ? "El registro ha sido actualizado." : "Error al intentar actualizar el registro.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to('/admin/paises')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);
        $eliminado = $pais->delete();
        $mensaje = $eliminado ? "El registro ha sido eliminado." : "Error al intentar eliminar el registro.";
        $tipoMensaje = $eliminado ? "success" : "danger";

        return Redirect::to('/admin/paises')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/paises');
        }

        $filtro = $request->filtro;
        $pantalla = $this->pantalla;
        $paises = Pais::where('nombre','Like','%'.$filtro.'%')
                        ->paginate(15);

        return view('admin.paises.grid', compact('pantalla','paises','filtro'));

    }

    public function getPaises()
    {
        $paises = Pais::select('id','nombre')->get();
        return response()->json($paises->ToArray());
    }
}
