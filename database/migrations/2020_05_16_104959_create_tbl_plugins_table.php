<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plugins', function (Blueprint $table) {
            $table->bigIncrements('plg_id');
            $table->integer('user_id');
            $table->text('plg_js_code', 20000);
            $table->text('plg_ts_code', 20000);
            $table->text('plg_js_plain', 20000);
            $table->double('plg_gdp_create');
            $table->double('plg_gdp_publish');
            $table->double('plg_gdp_expires');
            $table->integer('plg_show');
            $table->string('plg_tag', 50);
            $table->string('plg_title', 200);
            $table->string('plg_desc', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_plugins');
    }
}
