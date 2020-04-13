<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('tbl_users', function (Blueprint $table) {
             $table->bigIncrements('user_id');
             $table->string('user_name');
             $table->string('user_pass_hash');
             $table->string('user_email');
             $table->integer('user_active');
             $table->integer('user_access_level');
             $table->string('user_reset_token');
             $table->string('user_desc');
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
        Schema::dropIfExists('tbl_users');
    }
}
