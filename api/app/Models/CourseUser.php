<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'course_user';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'inscription_date', //fecha en la que se inscribio al curso
        'payment_amount', //monto del pago que realizo al momento de inscribirse
        'completion_percentage', //porcentaje de lo completado del usuario en el curso
        'average_grade', //nota promedio del usuario en el curso
        'certificate', //url del certificado cuando finaliza el curso
        'course_id', //id del curso inscripto
        'user_id', //id del usuario inscripto
    ];
}
