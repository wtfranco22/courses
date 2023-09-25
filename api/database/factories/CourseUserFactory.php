<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as FakerGenerator;

class CourseUserFactory extends Factory
{
    private $userCourses = [];

    public function definition()
    {
        $faker = app(FakerGenerator::class);
        $users = User::where('role_id', 3)->get();

        // Obtener un usuario aleatorio
        $user = $faker->randomElement($users);

        // Obtener un curso al azar que el usuario aún no haya realizado
        $course = $this->getUniqueCourseForUser($user);

        // Registrar el curso en el que el usuario se ha inscrito
        $this->userCourses[$user->id][] = $course->id;

        return [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'inscription_date' => Carbon::now(),
            'payment_amount' => $faker->randomFloat(2, 10, 200),
        ];
    }

    private function getUniqueCourseForUser(User $user)
    {
        $existingCourses = $this->userCourses[$user->id] ?? [];

        // Obtener cursos disponibles que el usuario aún no ha realizado
        $availableCourses = Course::whereNotIn('id', $existingCourses)->get();

        if ($availableCourses->isEmpty()) {
            // Si el usuario ha completado todos los cursos disponibles, reiniciar la lista de cursos
            $this->userCourses[$user->id] = [];
            $availableCourses = Course::all();
        }

        // Obtener un curso aleatorio de los disponibles
        return $availableCourses->random();
    }
}
