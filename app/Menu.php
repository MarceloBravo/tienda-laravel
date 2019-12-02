<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = "Menus";

    protected $fillable = [
        'nombre', 'icono_class', 'menu_padre_id', 'pantalla_id', 'posicion', 'url'
    ];

    //un menu a una pantalla
    public function pantalla()
    {
        return $this->belongsTo('App\Pantalla');
    }

    public function subMenus()
    {
        return $this->hasMany('App\Menu','id','menu_padre_id');
    }

    public function menuPadre()
    {
        return $this->belongsTo('App\Menu','menu_padre_id','id');
    }
}
