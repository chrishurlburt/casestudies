<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Study;
use App\Keyword;
use App\Outcome;
use App\Course;

class TaggedStudiesTableSeeder extends Seeder
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
        $keywords  =  Keyword::all()->lists('id')->toArray();
        $outcomes  =  Outcome::all()->lists('id')->toArray();
        $courses   =  Course::all()->lists('id')->toArray();

        foreach(range(1, 50) as $index) {
            DB::table('tagged_studies')->insert([
                'study_id'    => $faker->randomElement($studies),
                'keyword_id'  => $faker->randomElement($keywords),
                'outcome_id'  => $faker->randomElement($outcomes),
                'course_id'   => $faker->randomElement($courses)
            ]);


        }

    }
}
