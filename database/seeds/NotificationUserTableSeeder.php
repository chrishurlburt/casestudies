<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\User;
use App\Notification;
use \Sentinel;

class NotificationUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = Sentinel::findRoleBySlug('admin')->users()->lists('id')->toArray();
        $notifications  =  Notification::all()->lists('id')->toArray();

        foreach(range(1, 5) as $index) {
            DB::table('notification_user')->insert([
                'user_id'          => $faker->randomElement($users),
                'notification_id'  => $faker->randomElement($notifications),
            ]);
        }
    }

}
