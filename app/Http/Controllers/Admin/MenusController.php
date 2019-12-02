<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MenusRequest;
use App\Menu;
use App\Pantalla;
use Redirect;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filtro = "")
    {
        $menus = Menu::paginate(15);

        return view('admin.menus.grid', compact('menus','filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new Menu();
        $menuPadre = Menu::pluck('nombre','id');
        $pantallas = Pantalla::pluck('nombre','id');
    
        return view('admin.menus.create', compact('menu','menuPadre','pantallas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $menu = new Menu();
        $grabado = $menu->fill($request->all())->save();
        $mensaje = $grabado ? "El registro ha sido grabado. Selecciona \"Home\" en el menú lateral para apreciar los cambios." : "Ocurrió un error al intentar ingresar el registro.";
        $tipoMensaje = $grabado ? "success" : "danger";

        return Redirect::to('/admin/menus')->with('message',$mensaje)->with('type-message',$tipoMensaje);
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
        $menu = Menu::find($id);
        $menuPadre = Menu::pluck('nombre','id');
        $pantallas = Pantalla::pluck('nombre','id');

        return view('admin.menus.edit', compact('menu','menuPadre','pantallas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenusRequest $request, $id)
    {
        $menu = Menu::find($id);
        $actualizado = $menu->fill($request->all())->save();
        $mensaje = $actualizado ? "El registro ha sido actualizado. Selecciona \"Home\" en el menú lateral para apreciar los cambios." : "Ocurrió un error al intentar actualizar el registro.";
        $tipoMensaje = $actualizado ? "success" : "danger";

        return Redirect::to('/admin/menus')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $eliminado = $menu->delete();
        $mensaje = $eliminado ? "El registro ha sido eliminado. Selecciona \"Home\" en el menú lateral para apreciar los cambios." : "Ocurrió un error al intentar eliminar el registro.";
        $tipoMensaje = $eliminado ? "success" : "danger";

        return Redirect::to('/admin/menus')->with('message',$mensaje)->with('type-message',$tipoMensaje);
    }

    public function filtrar(Request $request)
    {
        if(!isset($request->filtro) || $request->filtro == "")
        {
            return Redirect::to('/admin/menus');
        }
        $filtro = $request->filtro;
        $menus = Menu::join('pantallas','menus.id','=','pantallas.id')
                    ->where('menus.nombre','Like','%'.$filtro.'%')
                    ->orWhere('pantallas.nombre','Like','%'.$filtro.'%')
                    ->paginate(15);

        return view('admin.menus.grid', compact('menus', 'filtro'));
    }
}
