<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $table = 'categorias';
    //
    protected $fillable = [
        'nombre', 'slug', 'descripcion', 'color'
    ];

    public function productos(){
        $this->hasMany('App\Producto');
    }
}
