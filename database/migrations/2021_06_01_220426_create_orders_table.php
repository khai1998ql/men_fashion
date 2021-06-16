<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('order_code')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('order_subtotal')->nullable();
            $table->integer('order_shipping')->nullable();
            $table->integer('order_vat')->nullable();
            $table->integer('order_sale')->nullable();
            $table->integer('order_coupons')->nullable();
            $table->integer('order_total')->nullable();
            $table->integer('order_status')->nullable()->default(0);
            $table->integer('order_day')->nullable();
            $table->integer('order_month')->nullable();
            $table->integer('order_year')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
