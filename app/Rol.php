<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use SoftDeletes;

    protected $table = 'roles';
    //
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    //Relación uno a muchos
    public function usuarios(){
        return $this->hasMany('App\User');
    }
}
