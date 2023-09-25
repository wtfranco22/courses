<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as FakerGenerator;

class ModuleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(FakerGenerator::class);

        //obtenemos todos los usuarios con sus cursos
        $users = User::whereHas('courses')->get();

        //recorremos a cada usuario
        foreach ($users as $user) {

            //guardamos los cursos del usuario
            $courses = $user->courses;

            //recorremos cada curso
            foreach ($courses as $course) {

                //guardamos los modulos de cada curso
                $modules = $course->modules;

                //guardamos la relacion por bloques del usuario con acceso a los modulos con los siguientes valores
                $user->modules()->attach($modules,[
                    'enabled'=>false,
                    'state'=>'not started',
                    'calification'=>0.0,
                    'description'=>$faker->paragraph()
                    ]
                );
            }
        }
    }
}
