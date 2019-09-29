<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
//use Illuminate\Database\Eloquent\SoftDeletes; //La tabla pivote no puede utilizar softDeletes

class OrdenItem extends Pivot
{
    protected $table = 'ordenes_items';
    //    
}
