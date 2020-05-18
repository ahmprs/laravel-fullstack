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
            'plg_js_code' => 'var test=[]; test["init"] = function(ownerId){console.log("TEST TEMPLATE "+ownerId);}',
            'plg_ts_code' => 'var test=[]; test["init"] = function(ownerId){console.log("TEST TEMPLATE "+ownerId);}',
            'plg_js_plain' => 'var test=[]; test["init"] = function(ownerId){console.log("TEST TEMPLATE "+ownerId);}',
            'plg_cls' => 'test',
            'plg_gdp_create' => '737373',
            'plg_gdp_publish' => '737373',
            'plg_gdp_expires' => '738383',
            'plg_show' => '1',
            'plg_tag' => 'HOME',
            'plg_title' => 'TITLE',
            'plg_desc' => '',
        ]);        
    }
}
