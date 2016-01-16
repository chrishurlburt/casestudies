<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OutcomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,8) as $index) {
            DB::table('outcomes')->insert([
                'name'        => $faker->unique()->word,
                'description' => $faker->sentence($nbWords = rand(4, 8))
            ]);
        }
    }
}
