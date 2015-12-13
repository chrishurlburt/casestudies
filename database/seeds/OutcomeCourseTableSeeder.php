<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Course;
use App\Outcome;

class OutcomeCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $courses   =  Course::all()->lists('id')->toArray();
        $outcomes  =  Outcome::all()->lists('id')->toArray();

        foreach(range(1, 25) as $index) {
            DB::table('course_outcome')->insert([
                'course_id'    => $faker->randomElement($courses),
                'outcome_id'  => $faker->randomElement($outcomes),
            ]);
        }
    }
}
