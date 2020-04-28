<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->integer('parent')->nullable();
            $table->string('slug');
            $table->string('image_sm', 255)->nullable();
            $table->string('image_md', 255)->nullable();
            $table->string('image_lg', 255)->nullable();
            $table->boolean('status')->default(false)->nullable();
            $table->boolean('featured')->default(false)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
