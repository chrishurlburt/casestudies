<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
                'slug'         => 'admin',
                'name'         => 'Admin',
                'permissions'  => '{

                        "publish": true,
                        "admin.cases.index": true,
                        "admin.cases.create":true,
                        "admin.cases.store": true,
                        "admin.cases.edit": true,
                        "admin.cases.update": true,
                        "admin.cases.destroy": true,
                        "admin.cases.show": true,
                        "admin.cases.drafts": true,

                        "admin.courses.index": true,
                        "admin.courses.create": true,
                        "admin.courses.store": true,
                        "admin.courses.edit": true,
                        "admin.courses.update": true,
                        "admin.courses.destroy": true,
                        "admin.courses.show": true,

                        "admin.outcomes.index": true,
                        "admin.outcomes.create": true,
                        "admin.outcomes.store": true,
                        "admin.outcomes.edit": true,
                        "admin.outcomes.update": true,
                        "admin.outcomes.destroy": true,
                        "admin.outcomes.show": true,

                        "admin.users.index": true,
                        "admin.users.create": true,
                        "admin.users.store": true,
                        "admin.users.edit": true,
                        "admin.users.update": true,
                        "admin.users.activate": true,
                        "admin.users.destroy": true,
                        "admin.users.show": true
                    }',
        ]);

        DB::table('roles')->insert([
                'slug'         => 'analyst',
                'name'         => 'Analyst',
                'permissions'  => '{

                        "publish": false,
                        "admin.cases.index": true,
                        "admin.cases.create":true,
                        "admin.cases.store": true,
                        "admin.cases.edit": true,
                        "admin.cases.update": true,
                        "admin.cases.destroy": true,
                        "admin.cases.show": true,
                        "admin.cases.drafts": true,

                        "admin.courses.index": false,
                        "admin.courses.create": false,
                        "admin.courses.store": false,
                        "admin.courses.edit": false,
                        "admin.courses.update": false,
                        "admin.courses.destroy": false,
                        "admin.courses.show": false,

                        "admin.outcomes.index": false,
                        "admin.outcomes.create": false,
                        "admin.outcomes.store": false,
                        "admin.outcomes.edit": false,
                        "admin.outcomes.update": false,
                        "admin.outcomes.destroy": false,
                        "admin.outcomes.show": false,

                        "admin.users.index": false,
                        "admin.users.create": false,
                        "admin.users.store": false,
                        "admin.users.edit": false,
                        "admin.users.update": false,
                        "admin.users.destroy": false,
                        "admin.users.show": false
                    }',
        ]);

    }
}
