<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_sm', 255);
            $table->string('image_md', 255);
            $table->string('image_lg', 255);
            $table->string('title', 255)->nullable();
            $table->string('caption', 255)->nullable();
            $table->integer('set_order')->nullable();
            $table->string('url_link', 255)->nullable();
            $table->string('url_text')->nullable();
            $table->string('slider_location')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
