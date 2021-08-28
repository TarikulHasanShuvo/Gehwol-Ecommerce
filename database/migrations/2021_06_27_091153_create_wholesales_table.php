<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWholesalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wholesales', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('email',50);
            $table->string('phone',50)->nullable();
            $table->string('order_no',100)->nullable();
            $table->boolean('read')->default(0)->comment('0 = unread , 1 = read');
            $table->text('message')->nullable();
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
        Schema::dropIfExists('wholesales');
    }
}
