<?php

use Illuminate\Database\Seeder;

class seed_tbl_div_docs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_div_docs')->insert([
            'doc_id' => null,
            'user_id' => '0',
            'doc_content' => '<div>TEST DIV DOC</div>',
            'doc_gdp_create' => '737373',
            'doc_gdp_publish' => '737373',
            'doc_gdp_expires' => '737383',
            'doc_show' => '1',
            'doc_rank' => '100',
            'doc_tag' => 'HOME',
            'doc_title' => 'TITLE',
            'doc_desc' => '',
        ]);        
    }
}
