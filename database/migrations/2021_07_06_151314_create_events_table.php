<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('author')->nullable();
            $table->string('type')->nullable()->comment('virtual');
            $table->integer('total_seat')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('modified_by')->nullable();
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
        Schema::dropIfExists('events');
    }
}
