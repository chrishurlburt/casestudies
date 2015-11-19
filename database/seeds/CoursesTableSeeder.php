<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,12) as $index) {
            DB::table('courses')->insert([
                'name'         => $faker->sentence($nbWords = rand(3, 6)),
                'description'  => $faker->sentence($nbWords = rand(6, 12))
            ]);
        }
    }
}
