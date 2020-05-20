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
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('user_address_id')->nullable();
            $table->float('subtotal_price', 10, 2);
            $table->float('discount_price', 10, 2)->nullable();
            $table->float('shipping_charge', 10, 2)->nullable();
            $table->integer('shipping_slot_id')->default(null)->nullable();
            $table->integer('coupon_id')->nullable();
            $table->text('order_note')->nullable()->default(null);
            $table->string('payment_method')->default(null)
                                            ->nullable()
                                            ->comment('online, cod');
            $table->boolean('payment_status')
                                            ->default(false)
                                            ->nullable();
            $table->string('order_status')->default(false)
                                        ->nullable()
                                        ->comment('pending, 
                                                    in_process, 
                                                    in_transit, delivered, cancelled');
            $table->string('addr_name', 200);
            $table->string('addr_mobile', 15);
            $table->string('addr_email', 200);
            $table->string('addr_landmark', 255);
            $table->string('addr_line1', 255);
            $table->string('addr_line2', 255)->default(null)->nullable();
            $table->string('addr_country');
            $table->string('addr_state');
            $table->string('addr_district');
            $table->string('addr_pincode');
            $table->string('addr_location');
            $table->integer('pincode_id');
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
