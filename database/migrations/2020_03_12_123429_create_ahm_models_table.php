<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAhmModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This is a test table presenting some 
        // useful data types.
        // Web: 
        // https://laravel.com/docs/5.0/schema#creating-and-dropping-tables
        Schema::create('tbl_test', function (Blueprint $table) {
            $table->bigIncrements('test_id');
            $table->timestamps();
            $table->char('test_jal_date', 10);
            $table->date('test_greg_date');
            $table->dateTime('test_greg_date_time');
            $table->time('test_time');
            $table->decimal('test_cost', 5, 2);
            $table->double('test_precision', 15, 8);
            $table->enum('test_gender', ['male', 'female', 'other']);
            $table->float('test_discount_rate')->default(0);
            $table->integer('test_number');
            $table->boolean('test_active');
            $table->string('test_attender_email')->nullable();
            $table->text('description')->nullable();
            $table->longText('extra_descriptions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_test');
    }
}
