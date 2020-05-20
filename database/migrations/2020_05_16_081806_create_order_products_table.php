<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('image_sm');
            $table->string('slug');
            $table->integer('quantity')->default(1);
            $table->float('product_price', 10, 2)
                                        ->comment('includes attributes price');
            $table->float('attr_prices')
                                        ->default(0.00)
                                        ->nullable()
                                        ->comment('all attr prices');
            $table->json('product_options')->default(null)->nullable();
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
        Schema::dropIfExists('order_products');
    }
}
