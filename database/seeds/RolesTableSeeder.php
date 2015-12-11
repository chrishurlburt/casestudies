<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
                'slug'         => 'admin',
                'name'         => 'Admin',
                'permissions'  => '{"publish": true, "admin.accounts": true}',
        ]);

        DB::table('roles')->insert([
                'slug'         => 'analyst',
                'name'         => 'Analyst',
                'permissions'  => '{"publish": false, "admin.accounts": false}'
        ]);

    }
}
