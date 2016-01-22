<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 7; $i++) {
            DB::table('role_users')->insert([
                    'user_id' => $i,
                    'role_id' => 1
            ]);
        }
    }
}
