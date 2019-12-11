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
        'subtotal', 'shiping', 'user_id', 'estado_id'
    ];

    //Relación muchos a uno (uno a muchos inverso a usuarios)
    public function usuarios(){
        return $this->belongsTo('App\User','user_id','id'); //La relación se implementa en usuarios
    }

    public function itemsOrden()
    {
        return $this->belongsTo('App\OrdenItem','id','orden_id');
    }

    public function OrdenWebPay()
    {
        return $this->belongsTo('App\OrdenWebPay');
    }

    public function estado()
    {
        return $this->belongsTo('App\Estado','estado_id','id');
    }
}
