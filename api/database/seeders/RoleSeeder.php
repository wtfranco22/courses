<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'description' => 'Rol de administrador',
        ]);

        Role::create([
            'name' => 'Docente',
            'description' => 'Rol de los que van a dar las clases de ciertos modulos',
        ]);

        Role::create([
            'name' => 'Estudiante',
            'description' => 'Rol para quienes se inscriben en algun curso',
        ]);
    }
}
