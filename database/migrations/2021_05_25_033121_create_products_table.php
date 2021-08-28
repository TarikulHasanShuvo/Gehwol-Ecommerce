<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('product_category_id')->constrained('product_categories');
            $table->string('price')->nullable();
            $table->string('code')->nullable();
            $table->string('sku')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('unit_value')->nullable();
            $table->string('brand')->nullable();
            $table->text('ingredient')->nullable();
            $table->mediumText('description')->nullable();
            $table->tinyInteger('new')->default(1);
            $table->tinyInteger('professional')->default(0);
            $table->text('title_img')->nullable();
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
        Schema::dropIfExists('products');
    }
}
