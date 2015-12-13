<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Study;
use App\Outcome;

class OutcomeStudyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $studies   =  Study::all()->lists('id')->toArray();
        $outcomes  =  Outcome::all()->lists('id')->toArray();

        foreach(range(1, 50) as $index) {
            DB::table('outcome_study')->insert([
                'study_id'    => $faker->randomElement($studies),
                'outcome_id'  => $faker->randomElement($outcomes),
            ]);
        }
    }
}
