<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('product_bl_category_id')->after('product_category_id')->constrained('product_bl_categories');
            $table->foreignId('product_range_id')->after('product_bl_category_id')->constrained('product_ranges');
            $table->foreignId('product_type_id')->after('product_range_id')->constrained('product_types');
            $table->string('original_price')->nullable()->after('price');
            $table->tinyInteger('no_of_identical_products')->default(1)->after('product_type_id');
            $table->string('french_name')->nullable()->after('name');
            $table->text('french_description')->nullable()->after('description');
            $table->string('upc_code')->nullable()->after('code');
            $table->string('uom')->nullable()->after('upc_code');
            $table->text('how_to_use')->nullable()->after('french_description');
            $table->text('who_can_use')->nullable()->after('how_to_use');
            $table->text('whats_it_for')->nullable()->after('who_can_use');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('product_bl_category_id');
            $table->dropColumn('product_range_id');
            $table->dropColumn('product_type_id');
            $table->dropColumn('no_of_identical_products');
            $table->dropColumn('french_name');
            $table->dropColumn('original_price');
            $table->dropColumn('french_description');
            $table->dropColumn('upc_code');
            $table->dropColumn('uom');
            $table->dropColumn('how_to_use');
            $table->dropColumn('who_can_use');
            $table->dropColumn('whats_it_for');
        });
    }
}
