<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as FakerGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = app(FakerGenerator::class);

        $courseId = $faker->randomElement([1, 2, 3, 4, 5]); // Curso aleatorio

        // Contar la cantidad de modulos existentes para el curso seleccionado
        $moduleCount = Module::where('course_id', $courseId)->count();

        return [
            'name' => $faker->word,
            'description' => $faker->paragraph(),
            'order' => $moduleCount + 1, // Asignar el orden siguiente al último módulo
            'course_id' => $courseId,
        ];
    }
}
