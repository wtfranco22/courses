<?php

use App\Models\Course;
use App\Models\User;

/**
 * @param array<string,mixed> $courseData
 * @return boolean
 */
function inscriptionCourse($courseData)
{
    if (auth()->user()->role->name != 'Estudiante') {
        throw new \Exception('No tiene permiso para inscribirse a un curso');
    }
    $course = Course::find($courseData['course_id']);
    if (!$course->enabled && $courseData['sale']) {
        throw new \Exception('El curso no está en promoción en este momento');
    }
    if (auth()->user()->courses->contains($course)) {
        throw new \Exception('Ya esta inscripto en el curso');
    }
    $user = User::find(auth()->user()->id);
    $course_user = [
        'inscription_date' => now(),
        'payment_amount' => ($course->enabled ? 1000 : $course->price),
        'completion_percentage' => 0,
        'average_grade' => 0.0,
        'certificate' => '',
    ];
    $user->courses()->attach($course, $course_user);
    return true;
}
