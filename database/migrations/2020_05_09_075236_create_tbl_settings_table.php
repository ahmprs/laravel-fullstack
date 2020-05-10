<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_settings', function (Blueprint $table) {
            $table->bigIncrements('stg_id');
            $table->integer('user_id');
            $table->string('stg_caption', 400);
            $table->string('stg_key', 100);
            $table->string('stg_val', 500);
            $table->enum('stg_type', ['text','gdp','option','number']);
            $table->string('stg_options', 600);
            $table->string('stg_min',20);
            $table->string('stg_max',20);
            $table->string('stg_extra',400);
            $table->string('stg_desc',400);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_settings');
    }
}
