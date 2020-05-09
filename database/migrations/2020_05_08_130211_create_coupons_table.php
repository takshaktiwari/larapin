<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon');
            $table->float('percent', 10, 2)->nullable()
                                        ->comment('discount in percent');
            $table->float('amount', 10, 2)->nullable()
                                        ->comment('discount in amount');
            $table->float('min_purchase', 10, 2)->nullable()
                                        ->comment('Applicable at min perchase of');
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
