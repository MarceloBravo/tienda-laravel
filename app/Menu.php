<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = "Menus";

    protected $fillable = [
        'nombre', 'icono_class', 'menu_padre_id', 'pantalla_id'
    ];

    //Muchos a uno (un menu a una pantalla)
    public function pantalla()
    {
        return $this->hasOne('App\Pantalla');
    }
}
