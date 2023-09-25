<?php

namespace Database\Seeders;

use Database\Factories\FileFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileFactory::new()->times(150)->create();
    }
}
