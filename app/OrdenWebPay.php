<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenWebPay extends Model
{
    use SoftDeletes;

    protected $table = 'webpay_transactions';

    protected $fillable = ['orden_id',
        'accountingDate', 'buyOrder', 'cardNumber', 'cardExpirationDate', 'authorizationCode',
        'paymentTypeCode', 'responseCode', 'sharesNumber', 'amount', 'commerceCode', 'transactionDate',
        'VCI','token'];

    public function ordenes()
    {
        return $this->hasMany('App\Orden');
    }
}
