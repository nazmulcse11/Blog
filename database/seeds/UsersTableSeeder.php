<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Md. Admin',
            'role_id' => '1',
            'email' => 'admin@blog.com',
            'password' => bcrypt('admin'),
        ]);


        DB::table('users')->insert([
            'name' => 'Md. Author',
            'role_id' => '2',
            'email' => 'author@blog.com',
            'password' => bcrypt('author'),
        ]);
    }
}
