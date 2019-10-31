<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpay_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('orden_id')->unsigned();
            $table->foreign('orden_id')->references('id')->on('ordenes')->onDelete('cascade');
            $table->integer('accountingDate');
            $table->string('buyOrder', 20);
            $table->string('cardNumber', 30);
            $table->string('cardExpirationDate')->nullable();
            $table->integer('authorizationCode');
            $table->string('paymentTypeCode', 10);
            $table->integer('responseCode');
            $table->integer('sharesNumber');
            $table->decimal('amount',12, 2);
            $table->string('commerceCode',30);
            $table->string('transactionDate',30);
            $table->string('VCI', 10);
            $table->string('token');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webpay_transactions');
    }
}
