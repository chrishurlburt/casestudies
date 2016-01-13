<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,100) as $index) {
            DB::table('keywords')->insert([
                'name' => $faker->unique()->word
            ]);
        }
    }
}
