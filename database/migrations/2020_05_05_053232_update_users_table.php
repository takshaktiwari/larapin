<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->string('api_token', 80)->after('email')
                                            ->unique()
                                            ->nullable()
                                            ->default(null);
            $table->integer('role_id')->after('api_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'api_token')){
            Schema::table('users', function (Blueprint $table){
                $table->dropColumn('api_token');
            });
        }
        if (Schema::hasColumn('users', 'role_id')){
            Schema::table('users', function (Blueprint $table){
                $table->dropColumn('role_id');
            });
        }
    }
}
