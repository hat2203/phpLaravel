<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime("order_date");
            $table->unsignedDecimal("grand_total",12,4);
            $table->string("fist_name");
            $table->string("last_name");
            $table->string("country");
            $table->text("shipping_address");
            $table->string("post_code");
            $table->string("customer_tel",20);
            $table->string("customer_email");
            $table->unsignedTinyInteger("status")->default(0);
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
