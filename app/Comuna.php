<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comuna extends Model
{
    use SoftDeletes;

    protected $table = 'comunas';

    protected $fillable = ['nombre','id_regiones'];

    public function ciudades()
    {
        return $this->belongsTo('\App\regiones');
    }

    public function region()
    {
        return $this->hasOne('\App\regiones');
    }
}
