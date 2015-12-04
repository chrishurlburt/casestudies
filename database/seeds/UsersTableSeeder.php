<?php

use Illuminate\Database\Seeder;

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
            'email'      => 'churlburt132@g.rwu.edu',
            'password'   =>  bcrypt('test'),
            'permissions' => NULL,
            'last_login'  => NULL,
            'first_name' => 'Chris',
            'last_name'  => 'Hurlburt',
            'remember_token' => NULL
        ]);
    }
}
