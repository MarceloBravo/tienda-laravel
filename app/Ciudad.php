<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
    use SoftDeletes;

    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'id_comunas'];

    public function usuarios()
    {
        return $this->belongTo('\App\users');
    }

    public function comuna()
    {
        return $this->hasOne('\App\comunas');
    }
}
