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
        DB::table('user')->insert([
            'username' => 'husol',
            'email' => 'enquiry@husol.org',
            'is_admin' => 1,
            'password' => bcrypt('husol123ok'),
            'info'  => '{"name":"Husol","phone":"","address":"","role":{"vtb":"true","vbc":"true","sch":"true","cse":"true","isAdmin":"true"}}'
        ]);
        DB::table('user')->insert([
            'username' => 'admin',
            'email' => 'webmaster@ntt.edu.vn',
            'is_admin' => 1,
            'password' => bcrypt('123456'),
            'info'  => '{"name":"Admin","phone":"","address":"","role":{"vtb":"true","vbc":"true","sch":"true","cse":"true","isAdmin":"true"}}'
        ]);
    }
}
