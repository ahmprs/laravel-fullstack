<?php

use Illuminate\Database\Seeder;

class seed_tbl_comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_comments')->insert([
            'cmn_id' => null,
            'cmn_topic' => '',
            'cmn_text' => 'Ahwaz is a grate ancient city.',
            'cmn_approved' => '1',
        ]);        

        DB::table('tbl_comments')->insert([
            'cmn_id' => null,
            'cmn_topic' => '',
            'cmn_text' => 'Software industry needs patience, smart managers and undertaking staff.',
            'cmn_approved' => '1',
        ]);        
    }
}
