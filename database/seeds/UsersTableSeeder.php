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
            'name'      => 'Chris Hurlburt',
            'email'     => 'churlburt132@g.rwu.edu',
            'password'  =>  bcrypt('test')
        ]);
    }
}
