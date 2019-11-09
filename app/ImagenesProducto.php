<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagenesProducto extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'producto_id', 'url', 'principal', 'nombre_archivo'
    ];

    //Relación muchos a uno
    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}
