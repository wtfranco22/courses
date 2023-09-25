<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as FakerGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = app(FakerGenerator::class);
        return [
            'name' => $faker->sentence(3),
            'description'=>$faker->paragraph(3),
            'content'=>$faker->url,
        ];
    }
}
