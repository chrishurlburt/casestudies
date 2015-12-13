<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

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

        $users = User::all()->lists('id')->toArray();

        foreach(range(1,50) as $index) {
            DB::table('studies')->insert([
                'title'     => $faker->sentence($nbWords = rand(3, 6)),
                'problem'  => $faker->paragraph($nbSentences = rand(4,6)),
                'solution' => $faker->paragraph($nbSentences = rand(7,15)),
                'analysis' => $faker->paragraph($nbSentences = rand(4,6)),
                'slug'     => $faker->word,
                'user_id'  => $faker->randomElement($users)
            ]);
        }


    }
}
