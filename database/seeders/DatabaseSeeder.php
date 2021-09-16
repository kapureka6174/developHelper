<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::Class);
        $this->call(ServiceSeeder::Class);
        $this->call(CommentSeeder::Class);
        $this->call(LikeSeeder::Class);
        $this->call(TechFieldSeeder::Class);
        $this->call(TechSeeder::Class);
        $this->call(TaskSeeder::Class);
        $this->call(UriSeeder::Class);
        $this->call(RequirementSeeder::Class);
        $this->call(TagSeeder::Class);
        $this->call(PageSeeder::Class);
    }
}
