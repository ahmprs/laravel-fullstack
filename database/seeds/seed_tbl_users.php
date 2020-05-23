<?php
use Illuminate\Database\Seeder;
class seed_tbl_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users')->insert([
            'user_id' => null,
            'user_name' => 'admin',
            'user_pass_hash' => '94b87311b99d52101b21bc19058a70b3',
            'user_email' => 'info@alvandsofs.com',
            'user_active' => '1',
            'user_access_level' => '100',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        

        DB::table('tbl_users')->insert([
            'user_id' => null,
            'user_name' => 'Hoj',
            'user_pass_hash' => '202cb962ac59075b964b07152d234b70',
            'user_email' => 'hoj@hoj.com',
            'user_active' => '1',
            'user_access_level' => '1',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        

        DB::table('tbl_users')->insert([
            'user_id' => null,
            'user_name' => 'Ahm',
            'user_pass_hash' => '202cb962ac59075b964b07152d234b70',
            'user_email' => 'parszadeh.ahmad@gmail.com',
            'user_active' => '1',
            'user_access_level' => '1',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        
    }
}
