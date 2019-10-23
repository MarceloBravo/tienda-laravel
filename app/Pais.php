<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model
{
    use SoftDeletes;

    protected $table = 'paises';

    protected $fillable = ['nombre'];

    public function regiones()
    {
        return $this->belongsTo('\App\regiones');
    }
}
