<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as FakerGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
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
            'title' => $faker->sentence(4),
            'start_date' => $faker->date(),
            'coupons' => $faker->randomElement([2, 5, 10, null]),
            'image' => $faker->imageUrl(),
            'description' => $faker->paragraph(),
            'price' => $faker->randomFloat(2, 10, 200),
        ];
    }
}
