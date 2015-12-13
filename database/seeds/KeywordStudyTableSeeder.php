<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Study;
use App\Keyword;

class KeywordStudyTableSeeder extends Seeder
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

        foreach(range(1, 50) as $index) {
            DB::table('Keyword_Study')->insert([
                'study_id'    => $faker->randomElement($studies),
                'keyword_id'  => $faker->randomElement($keywords),
            ]);
        }

    }
}
