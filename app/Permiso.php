<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    use SoftDeletes;

    protected $table = 'Permisos';

    protected $fillable = [
        'rol_id', 'pantalla_id', 'acceder', 'crear', 'actualizar', 'eliminar'
    ];

    public function roles()
    {
        return $this->hasMany('App\Rol'); //Tiene muchos
    }

    public function pantallas()
    {
        return $this->hasMany('App\Pantalla');  //Tiene muchos
    }
}
