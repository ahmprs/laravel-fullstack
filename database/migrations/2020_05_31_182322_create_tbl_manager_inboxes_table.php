<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblManagerInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_manager_inboxes', function (Blueprint $table) {
            $table->bigIncrements('mng_id');
            $table->string('mng_sender', 1024);
            $table->string('mng_message',2048);
            $table->string('mng_resp',2048);
            $table->integer('mng_dismissed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_manager_inboxes');
    }
}
