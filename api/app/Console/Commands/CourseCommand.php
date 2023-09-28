<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Console\Command;

class CourseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Va a ejecutar el cambio del curso que se encuentra en promocion en ese momento';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $courseQuantity = Course::all()->count(); //vemos la cantidad

        $course = Course::all()->where('enabled', true)->firstOrFail(); //obtenemos al que esta en oferta

        $index = ($course->id + 1) % ($courseQuantity); //incrementamos 1 y si llega a la cantidad, es xq es el ultimo pero
        
        $indexNext = ($index == 0) ? $courseQuantity : $index;
        $course->update(['enabled'=>false]);

        $nextCourse = Course::find($indexNext);
        $nextCourse->update(['enabled'=>true]);

    }
}
