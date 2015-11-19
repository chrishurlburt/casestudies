<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            $this->call(StudiesTableSeeder::class);
            $this->call(CoursesTableSeeder::class);
            $this->call(KeywordsTableSeeder::class);
            $this->call(OutcomesTableSeeder::class);
            $this->call(TaggedStudiesTableSeeder::class);

        Model::reguard();
    }
}
