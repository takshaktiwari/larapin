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
            $table->integer('category_id')->nullable();
            $table->float('base_price', 10, 2)->default('0.00');
            $table->float('base_discount', 10, 2)->default('0.00');
            $table->text('short_description')->nullable();
            $table->text('product_tags')->nullable();
            $table->string('slug');
            $table->float('rating', 10, 1)->default('0')->nullable();
            $table->integer('reviews')->default('0')->nullable();
            $table->boolean('featured')->default(false)->nullable();
            $table->boolean('status')->default(true)->nullable();
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
