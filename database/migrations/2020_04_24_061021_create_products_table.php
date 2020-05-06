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
            $table->bigIncrements('id');
            $table->string('product_name', 255);
            $table->string('subtitle', 255)->nullable();
            $table->float('base_price', 10, 2)->default('0.00');
            $table->integer('base_stock')->nullable()->default('0');
            $table->text('short_description')->nullable();
            $table->text('product_tags')->nullable();
            $table->integer('brand_id')->nullable();
            $table->boolean('featured')->default(false)->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->string('slug');
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
