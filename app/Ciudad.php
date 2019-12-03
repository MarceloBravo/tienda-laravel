<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
    use SoftDeletes;

    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'id_comuna'];

    public function usuarios()
    {
        return $this->belongsTo('\App\users');
    }

    public function comuna()
    {
        return $this->hasOne('\App\comuna','id','id_comuna');
    }
}
