<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDivDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_div_docs', function (Blueprint $table) {
            $table->bigIncrements('doc_id');
            $table->integer('user_id');
            $table->text('doc_content', 10000);
            $table->double('doc_gdp_create');
            $table->double('doc_gdp_publish');
            $table->double('doc_gdp_expires');
            $table->integer('doc_show');
            $table->string('doc_tag', 50);
            $table->string('doc_title', 200);
            $table->string('doc_desc', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_div_docs');
    }
}
