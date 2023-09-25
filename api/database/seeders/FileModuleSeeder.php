<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todos los archivos y modulos disponibles
        $files = File::all();
        $modules = Module::all();

        // Iterar a traves de los modulos
        foreach ($modules as $module) {

            // Obtener una cantidad aleatoria de archivos para asignar a este modulo
            $randomFileCount = rand(5, 10);

            // Elegir archivos aleatorios para asignar al modulo
            $randomFiles = $files->random($randomFileCount);

            // Asignar los archivos al modulo con un orden especifico
            $order = 1;
            foreach ($randomFiles as $file) {
                $module->files()->attach($file, ['order' => $order]);
                $order++;
            }
        }
    }
}
