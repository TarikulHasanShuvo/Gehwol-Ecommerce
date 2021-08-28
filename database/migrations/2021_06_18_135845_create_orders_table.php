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
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('order_uid')->unique();
            $table->boolean('is_payment_completed')->default(0);
            $table->string('status')->nullable();
            $table->double('gst')->default(0);
            $table->double('discount')->default(0);
            $table->double('shipping_charge')->default(0);
            $table->double('total')->default(0);
            $table->timestamp('order_date')->nullable();
            $table->string('shipping_method')->nullable();
            $table->timestamp('shipped_date')->nullable();
            $table->string('ship_first_name')->nullable();
            $table->string('ship_last_name')->nullable();
            $table->string('ship_business_name')->nullable();
            $table->string('ship_address_line_1')->nullable();
            $table->string('ship_address_line_2')->nullable();
            $table->string('ship_postal_code')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('ship_phone')->nullable();
            $table->text('comments')->nullable();
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
