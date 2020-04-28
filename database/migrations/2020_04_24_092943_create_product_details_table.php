<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('sku_code')->nullable();
            $table->float('ship_charge')->nullable();
            $table->integer('ship_time')->nullable()->comment('in days');
            $table->text('description')->nullable();
            $table->string('m_title', 255)->nullable();
            $table->string('m_keywords', 255)->nullable();
            $table->string('m_description', 255)->nullable();
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
        Schema::dropIfExists('product_details');
    }
}
