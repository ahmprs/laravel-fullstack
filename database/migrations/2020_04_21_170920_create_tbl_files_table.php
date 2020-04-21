<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_files', function (Blueprint $table) {
            $table->bigIncrements('file_id');
            $table->integer('user_id');
            $table->string('file_org_name', 400);
            $table->string('file_new_name', 400);
            $table->integer('file_size_bytes');
            $table->string('file_target_dir', 400);
            $table->string('file_extension', 50);
            $table->double('file_gdp_create');
            $table->double('file_gdp_publish');
            $table->double('file_gdp_expires');
            $table->integer('file_show');
            $table->string('file_tag', 50);
            $table->string('file_title', 200);
            $table->string('file_desc', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_files');
    }
}
