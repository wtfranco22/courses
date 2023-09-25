<?php

namespace Database\Seeders;

use Database\Factories\CourseFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseFactory::new()->create([
            'title' => 'Frontend'
        ]);
        CourseFactory::new()->create([
            'title' => 'Backend'
        ]);
        CourseFactory::new()->create([
            'title' => 'FullStack'
        ]);
        CourseFactory::new()->create([
            'title' => 'Devops'
        ]);
        CourseFactory::new()->create([
            'title' => 'Machine Learning'
        ]);
    }
}
