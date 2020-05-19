<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(seed_tbl_users::class);
        $this->call(seed_tbl_settings::class);
        $this->call(seed_tbl_div_docs::class);
        $this->call(seed_tbl_plugins::class);
        $this->call(seed_tbl_plugin_use::class);
    }
}
