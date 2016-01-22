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

            $this->call(UsersTableSeeder::class);
            // $this->call(StudiesTableSeeder::class);
            // $this->call(CoursesTableSeeder::class);
            // $this->call(KeywordsTableSeeder::class);
            // $this->call(OutcomesTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(RoleUsersTableSeeder::class);
            // $this->call(KeywordStudyTableSeeder::class);
            // $this->call(OutcomeStudyTableSeeder::class);
            // $this->call(OutcomeCourseTableSeeder::class);
            // $this->call(NotificationsTableSeeder::class);
            // $this->call(NotificationUserTableSeeder::class);

        Model::reguard();
    }
}
