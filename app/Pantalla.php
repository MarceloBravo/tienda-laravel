<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pantalla extends Model
{
    use SoftDeletes;

    protected $table = "Pantallas";

    protected $fillable = [
        'nombre', 'permite_crear', 'permite_actualizar', 'permite_eliminar'
    ];

    //Relación uno a muchos (Una pantalla a muchos permnisos)
    public function permisos()
    {
        return $this->belongsTo('App\Permiso');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
    
    
}
