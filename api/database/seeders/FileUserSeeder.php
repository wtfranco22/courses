<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //obtenemos los usuario con los modulos asociados
        $users = User::whereHas('modules')->get();
        foreach ($users as $user) {
            $modules = $user->modules;
            foreach ($modules as $module) {

                //por cada modulos obtenemos todos los archivos 
                $files = $module->files;

                //y asociamos todos los archivos con el usuario
                $user->files()->attach($files,[
                    'downloaded'=>false,
                    'enabled'=>false
                ]);
            }
        }
    }
}
