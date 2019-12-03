<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Marca;
use Redirect;
use App\Http\Requests\MarcasRequest;

class MarcasController extends Controller
{

    public function __construct()
    {
        $model = new Marca(); 
        $tabla = $model->getTable();
        $this->middleware('permisos:'.$tabla.',acceder')->only('index');
        $this->middleware('permisos:'.$tabla.',crear')->only('create','store');
        $this->middleware('permisos:'.$tabla.',actualizar')->only('edit','update');
        $this->middleware('permisos:'.$tabla.',eliminar')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filtro = "")
    {
        $marcas = Marca::paginate(10);
 
        return view('admin.marcas.grid', compact('marcas','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marca = new Marca();

        return view('admin.marcas.create', compact('marca'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcasRequest $request)
    {
        $marca = new Marca();
        $result = $marca->fill($request->all())->save();

        $mensaje = $result ? "La marca ha sido ingresada." : "Error al intentar registrar la marca.";
        $tipo = $result ? "success" : "danger";

        return Redirect::to('/admin/marcas')->with('message',$mensaje)->with('type-message',$tipo);
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
        $marca = Marca::find($id);

        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcasRequest $request, $id)
    {
        $marca = Marca::find($id);
        $marca->fill($request->all());
        $result = $marca->save();
        
        $mensaje = $result ? "El registro ha sido actualizada." : "Error al intentar actualizar el registro.";
        $tipo = $result ? "success" : "danger";

        return Redirect::to('/admin/marcas')->with('message',$mensaje)->with('type-message', $tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marca::find($id);
        $result = $marca->delete();

        $mensaje = $result ? "El registro ha sido eliminado." : "Error al intentar eliminar el registro.";
        $tipo = $result ? "success" : "danger";

        return Redirect::to('/admin/marcas')->with('message',$mensaje)->with('type-message',$tipo);
    }



    public function filtrar(Request $request)
    {
        $filtro = $request->filtro;
        if($filtro == "")
        {
            return Redirect::to('/admin/marcas')->with('filtro',$filtro);
        }
        $marcas = Marca::where('nombre','Like','%'.$filtro.'%')
                            ->paginate(10);
        
        return view('admin.marcas.grid', compact('marcas','filtro'));
                    
    }
}
