<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebPayErrTransaction extends Model
{
    use SoftDeletes;

    protected $table = 'webpay_transactions_errors';

    protected $fillable = ['orden_id','token_webpay'];


}
