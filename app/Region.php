<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    protected $table= 'regiones';

    protected $fillable = ['nombre', 'id_paises'];

    public function comunas()
    {
        return $this->belongsTo('\App\Comuna');
    }

    public function pais()
    {
        return $this->hasOne('\App\Pais');
    }
}
