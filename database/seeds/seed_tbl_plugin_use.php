<?php

use Illuminate\Database\Seeder;

class seed_tbl_plugin_use extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_plugin_uses')->insert([
            'rec_id' => null,
            'plg_id' => 1,
            'plg_gdp_create' => "737373",
            'plg_gdp_publish' => "737373",
            'plg_gdp_expires' => "737573",
            'plg_show' => 1,
            'plg_tag' => "HOME",
        ]);        
    }
}
