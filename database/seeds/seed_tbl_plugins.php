<?php

use Illuminate\Database\Seeder;

class seed_tbl_plugins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_plugins')->insert([
            'plg_id' => null,
            'user_id' => '0',
            'plg_js_code' => 'var test1=[]; test1["init"] = function(ownerId){console.log("TEST1 TEMPLATE "+ownerId);};',
            'plg_ts_code' => 'var test1=[]; test1["init"] = function(ownerId){console.log("TEST1 TEMPLATE "+ownerId);};',
            'plg_js_plain' => 'var test1=[]; test1["init"] = function(ownerId){console.log("TEST1 TEMPLATE "+ownerId);};',
            'plg_cls' => 'test1',
            'plg_title' => 'TITLE',
            'plg_desc' => '',
        ]);        

        DB::table('tbl_plugins')->insert([
            'plg_id' => null,
            'user_id' => '0',
            'plg_js_code' => 'var test2=[]; test2["init"] = function(ownerId){console.log("TEST2 TEMPLATE "+ownerId);};',
            'plg_ts_code' => 'var test2=[]; test2["init"] = function(ownerId){console.log("TEST2 TEMPLATE "+ownerId);};',
            'plg_js_plain' => 'var test2=[]; test2["init"] = function(ownerId){console.log("TEST2 TEMPLATE "+ownerId);};',
            'plg_cls' => 'test2',
            'plg_title' => 'TITLE',
            'plg_desc' => '',
        ]);        
    }
}
