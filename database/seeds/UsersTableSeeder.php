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
            'email'          => 'churlburt132@g.rwu.edu',
            'password'       =>  bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Chris',
            'last_name'      => 'Hurlburt',
            'remember_token' => NULL
        ]);

        DB::table('users')->insert([
            'email'          => 'bcelik@rwu.edu',
            'password'       =>  bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Bilge',
            'last_name'      => 'Celik',
            'remember_token' => NULL
        ]);

        DB::table('users')->insert([
            'email'          => 'aghanem@rwu.edu',
            'password'       => bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Amine',
            'last_name'      => 'Ghanem',
            'remember_token' => NULL
        ]);

        DB::table('users')->insert([
            'email'          => 'jsnarski917@g.rwu.edu',
            'password'       => bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Josh',
            'last_name'      => 'Snarski',
            'remember_token' => NULL
        ]);

        DB::table('users')->insert([
            'email'          => 'amiller229@g.rwu.edu',
            'password'       => bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Andrew',
            'last_name'      => 'Miller',
            'remember_token' => NULL
        ]);

        DB::table('users')->insert([
            'email'          => 'jhentze740@g.rwu.edu',
            'password'       => bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Jon',
            'last_name'      => 'Hentze',
            'remember_token' => NULL
        ]);

        DB::table('users')->insert([
            'email'          => 'kpeahl622@g.rwu.edu',
            'password'       => bcrypt('test'),
            'permissions'    => NULL,
            'last_login'     => NULL,
            'first_name'     => 'Kyle',
            'last_name'      => 'Peahl',
            'remember_token' => NULL
        ]);
    }
}
