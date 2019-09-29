<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';
    //
    protected $fillable = [
        'categoria_id', 'nombre', 'slug', 'descripcion', 'resumen',  'precio', 'imagen', 'visible'
    ];

    //Relacion muchos a uno
    public function categorias(){
        $this->belongsTo('App\Categoria');
    }

    //Relación muchos a muchos con una tabla pivote intermedia
    public function orden(){
        $this->belongsToMany('App\Orden')->using('App\OrdenItem')->withPivot(['created_at','updated_at']);
    }

}
