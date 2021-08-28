<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('cookie_id')->nullable();
            $table->string('type')->nullable()->comment('Birthday/others...');
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->string('client_name');
            $table->string('client_email');
            $table->double('amount');
            $table->double('available_balance')->default(0);
            $table->string('gift_card_code')->nullable();
            $table->boolean('is_active')->default(0)->comment("0 = No, 1 = Yes");
            $table->boolean('is_payment_completed')->default(0)->comment("0 = No, 1 = Yes");
            $table->text('message')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('purchased_at')->nullable();
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
        Schema::dropIfExists('gift_certificates');
    }
}
