<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $table = "estados";

    protected $fillable = ['nombre'];

    public function ordenes()
    {
        return $this->hasMany('App\Orden','id','estado_id');
    }
}
