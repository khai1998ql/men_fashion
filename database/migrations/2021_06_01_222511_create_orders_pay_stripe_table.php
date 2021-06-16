<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersPayStripeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_pay_stripe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->string('stripe_payment_id')->nullable();
            $table->string('stripe_payment_amount')->nullable();
            $table->string('stripe_blnc_transaction')->nullable();
            $table->string('stripe_order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_pay_stripe');
    }
}
