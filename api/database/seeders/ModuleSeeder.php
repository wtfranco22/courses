<?php

namespace Database\Seeders;

use Database\Factories\ModuleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as FakerGenerator;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalRecords = 30;
        $faker = app(FakerGenerator::class);
        
        // Array para realizar seguimiento del ultimo numero de orden para cada curso
        $lastOrder = [];

        // Iterar y crear modulos
        for ($i = 0; $i < $totalRecords; $i++) {
            // Curso aleatorio
            $courseId = rand(1, 5);

            $order = isset($lastOrder[$courseId]) ? ++$lastOrder[$courseId] : 1;
            
            DB::table('modules')->insert([
                'name' => $faker->word,
                'description' => $faker->paragraph(),
                'order' => $order,
                'course_id' => $courseId,
            ]);

            usleep(500000); // (0.5 segundos)

            // Actualizar el ultimo numero de orden para este curso
            $lastOrder[$courseId] = $order;
        }
    }
}
