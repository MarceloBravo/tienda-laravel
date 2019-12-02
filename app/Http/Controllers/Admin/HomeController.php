<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permiso;
use App\Menu;

class HomeController extends Controller
{
    public function index()
    {   
        \Session::put('menu', $this->menu());        
        return view('admin.home', compact('arrMenus'));
    }


    
    private function menu()
    {
        $arrMenus = array();   
        $menus = Menu::whereNull('menu_padre_id')
                    ->orderBy('menu_padre_id','asc')
                    ->orderBy('posicion','asc')
                    ->get();        
        
        foreach($menus as $item)
        {
            $itemMenu = array($item, $this->subMenus($item->id));
            array_push($arrMenus, $itemMenu);        
        }

        return $arrMenus;
    }
    
    private function subMenus($idMenuPadre)
    {
        $arrSubMenus = array();
        $menus = Menu::where('menu_padre_id','=',$idMenuPadre)
                    ->get();
        
        foreach($menus as $item)
        {            
            $itemMenu = array($item, $this->subMenus($item->id));
            array_push($arrSubMenus, $itemMenu);
        }                    
        
        return $arrSubMenus;
    }
    
    
}
