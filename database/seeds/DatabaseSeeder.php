<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Matt",
            'role' => 'admin',
            'email' => 'matt@admin.ca',
            'password' => bcrypt(env('ADMIN_CREDENTIALS', false))
        ]);
    }
}
