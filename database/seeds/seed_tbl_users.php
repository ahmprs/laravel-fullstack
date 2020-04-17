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
            'user_pass_hash' => '202cb962ac59075b964b07152d234b70',
            'user_email' => 'admin@admin.com',
            'user_active' => '1',
            'user_access_level' => '100',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        

        DB::table('tbl_users')->insert([
            'user_id' => null,
            'user_name' => 'Jack',
            'user_pass_hash' => '202cb962ac59075b964b07152d234b70',
            'user_email' => 'jack@jack.com',
            'user_active' => '1',
            'user_access_level' => '1',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        

        DB::table('tbl_users')->insert([
            'user_id' => null,
            'user_name' => 'Jim',
            'user_pass_hash' => '202cb962ac59075b964b07152d234b70',
            'user_email' => 'jim@jim.com',
            'user_active' => '1',
            'user_access_level' => '1',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        

        DB::table('tbl_users')->insert([
            'user_id' => null,
            'user_name' => 'Joe',
            'user_pass_hash' => '202cb962ac59075b964b07152d234b70',
            'user_email' => 'joe@joe.com',
            'user_active' => '1',
            'user_access_level' => '1',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        
    }
}
