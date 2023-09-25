<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un usuario administrador
        UserFactory::new()->create([
            'name' => 'Admin',
            'last_name' => 'Admin',
            'address' => 'Dirección Admin',
            'email' => 'wtfranco22@gmail.com',
            'role_id' => 1, // ID del rol de administrador
        ]);

        // Crear 5 usuarios docentes
        UserFactory::new()->times(5)->create([
            'role_id' => 2, // ID del rol de docente
        ]);

        // Crear 14 usuarios estudiantes
        UserFactory::new()->times(14)->create([
            'role_id' => 3, // ID del rol de estudiante
        ]);
    }
}
