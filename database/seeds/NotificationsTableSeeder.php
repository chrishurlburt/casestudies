<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Study;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Faker::create();
        $studies = Study::where('draft', true)->lists('id')->toArray();

        foreach(range(1,15) as $index) {
            DB::table('notifications')->insert([
                'notification' => $faker->sentence($nbWords = rand(4, 8)),
                'study_id'     => $faker->randomElement($studies),
            ]);
        }
    }
}
