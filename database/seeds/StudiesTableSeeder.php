<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $index) {
            DB::table('studies')->insert([
                'name'     => $faker->sentence($nbWords = rand(3, 6)),
                'problem'  => $faker->paragraph($nbSentences = rand(4,6)),
                'solution' => $faker->paragraph($nbSentences = rand(7,15)),
                'analysis' => $faker->paragraph($nbSentences = rand(4,6))
            ]);
        }


    }
}
