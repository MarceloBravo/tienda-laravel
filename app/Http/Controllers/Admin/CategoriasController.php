<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;
use App\Http\Requests\CategoriasRequest;
use Redirect;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filtro = "")
    {
        $categorias = Categoria::paginate(10);

        return view('admin.categorias.grid', compact('categorias','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria();

        return view('admin.categorias.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasRequest $request)
    {
        $categoria = new Categoria();
        $categoria->fill($request->all());
        $categoria->slug = str_slug($request->nombre);  //str_slug() -> composer require laravel/helpers
        $result = $categoria->save();

        $mensaje = $result ? "La categoría ha sido ingresada!" : "Error al intentar registrar la categoría!";
        $tipo = $result ? "success" : "danger";

        return Redirect::to('/admin/categorias')->with('message', $mensaje)->with('type-message',$tipo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  //Ver la inyección de dependencias en route/wep.php
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //Ver la inyección de dependencias en route/wep.php
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriasRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->slug = str_slug($request->nombre);  //str_slug() -> composer require laravel/helpers
        $result = $categoria->save();

        $mensaje = $result ? "La categoría ha sido actualizada!" : "Error al intentar actualizar la categoría!";
        $tipo = $result ? "success" : "danger";

        return Redirect::to('/admin/categorias')->with('message', $mensaje)->with('type-message',$tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)    //Ver la inyección de dependencias en route/wep.php
    {
        $categoria = Categoria::find($id);
        $result = $categoria->delete();
        $mensaje = $result ? 'La categoría ha sido eliminada' : 'Error al intentar eliminar el registro.';
        $tipo = $result ? 'success' : 'danger';

        return Redirect::to('/admin/categorias')->with('message',$mensaje)->with('type-message', $tipo);
    }



    public function filtrar(Request $request)
    {
        $filtro = $request->filtro;
        if($filtro == "")
        {
            return Redirect::to('/admin/categorias')->with('filtro',$filtro);
        }
        $categorias = Categoria::where('nombre','Like','%'.$filtro.'%')
                                ->orWhere('descripcion','Like','%'.$filtro.'%')
                                ->paginate();

        return view('admin.categorias.grid', compact('categorias','filtro'));        
    }
}
