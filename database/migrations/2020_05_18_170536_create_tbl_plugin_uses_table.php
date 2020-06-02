<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPluginUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plugin_uses', function (Blueprint $table) {
            $table->bigIncrements('rec_id');
            $table->integer('plg_id');
            $table->double('plg_gdp_create');
            $table->double('plg_gdp_publish');
            $table->double('plg_gdp_expires');
            $table->integer('plg_show');
            $table->integer('plg_rank');
            $table->string('plg_tag', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_plugin_uses');
    }
}
