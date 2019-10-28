<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Database\Eloquent\SoftDeletes; //La tabla pivote no puede utilizar softDeletes

class OrdenItem extends Pivot
{
    use SoftDeletes;

    protected $table = 'ordenes_items';
    //    

    protected $fillable = ['precio','cantidad','orden_id','producto_id'];

    public function orden()
    {
        return $this->hasMany('App\OrdenItem');
    }
}
