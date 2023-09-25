<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(CourseUserSeeder::class);
        $this->call(ModuleUserSeeder::class);
        $this->call(FileModuleSeeder::class);
        $this->call(FileUserSeeder::class);
    }
}
