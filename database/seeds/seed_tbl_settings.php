<?php

use Illuminate\Database\Seeder;

class seed_tbl_settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_settings')->insert([
            'stg_id' => null,
            'user_id' => '0',
            'stg_caption' => 'date format(persian[jal] / gregorian[greg])',
            'stg_key' => 'date_format',
            'stg_val' => 'jal',
            'stg_type' => 'option',
            'stg_options' => 'jal; greg',
            'stg_min' => '',
            'stg_max' => '',
            'stg_extra' => '',
            'stg_desc' => '',
        ]);        

        DB::table('tbl_settings')->insert([
            'stg_id' => null,
            'user_id' => '0',
            'stg_caption' => 'phone',
            'stg_key' => 'phone',
            'stg_val' => '(+98)6132233015',
            'stg_type' => 'text',
            'stg_options' => '',
            'stg_min' => '',
            'stg_max' => '',
            'stg_extra' => '',
            'stg_desc' => '',
        ]);        

        DB::table('tbl_settings')->insert([
            'stg_id' => null,
            'user_id' => '0',
            'stg_caption' => 'welcome message',
            'stg_key' => 'welcome_message',
            'stg_val' => 'Welcome to Alvand Softs',
            'stg_type' => 'text',
            'stg_options' => '',
            'stg_min' => '',
            'stg_max' => '',
            'stg_extra' => '',
            'stg_desc' => '',
        ]);        

        DB::table('tbl_settings')->insert([
            'stg_id' => null,
            'user_id' => '0',
            'stg_caption' => 'default duration days',
            'stg_key' => 'default_duration_days',
            'stg_val' => '90',
            'stg_type' => 'number',
            'stg_options' => '',
            'stg_min' => '0',
            'stg_max' => '3650',
            'stg_extra' => '',
            'stg_desc' => '',
        ]);        


        DB::table('tbl_settings')->insert([
            'stg_id' => null,
            'user_id' => '0',
            'stg_caption' => 'address',
            'stg_key' => 'address',
            'stg_val' => 'No.1 Alvand Building, Shariati Bulvard, Ahvaz, Iran',
            'stg_type' => 'text',
            'stg_options' => '',
            'stg_min' => '',
            'stg_max' => '',
            'stg_extra' => '',
            'stg_desc' => '',
        ]);        


        DB::table('tbl_settings')->insert([
            'stg_id' => null,
            'user_id' => '0',
            'stg_caption' => 'email',
            'stg_key' => 'email',
            'stg_val' => 'info@alvandsofts.com',
            'stg_type' => 'text',
            'stg_options' => '',
            'stg_min' => '',
            'stg_max' => '',
            'stg_extra' => '',
            'stg_desc' => '',
        ]);        

    }
}
