<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
    use SoftDeletes;

    protected $table = 'ordenes';
    //
    protected $fillable=[
        'subtotal', 'shiping', 'user_id'
    ];

    //Relación muchos a uno (uno a muchos inverso a usuarios)
    public function usuarios(){
        $this->belongsTo('App\User');
    }

}
