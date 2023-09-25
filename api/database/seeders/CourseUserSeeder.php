<?php

namespace Database\Seeders;

use Database\Factories\CourseUserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalRecords = 35;
        $records = CourseUserFactory::new()->times($totalRecords)->make();
        foreach ($records as $record) {
            DB::table('course_user')->insert($record->toArray());
            usleep(1000000); // (0.5 segundos)
        }
    }
}
