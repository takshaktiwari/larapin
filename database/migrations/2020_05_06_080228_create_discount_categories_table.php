<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->float('discount', 10, 2)
                                    ->default('0.00')   
                                    ->nullable()
                                    ->comment('discount in percentage');
            $table->dateTime('expires_at')
                                    ->nullable()
                                    ->comment('discount expiring date time');
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
        Schema::dropIfExists('discount_categories');
    }
}
