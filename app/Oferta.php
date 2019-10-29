<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oferta extends Model
{
    use SoftDeletes;
    //
    protected $table="ofertas";

    protected $fillable = ['src_imagen','texto1','texto2','fecha_expiracion','portada'];
}
